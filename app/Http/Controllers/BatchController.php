<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batch;
use App\Models\NestedCategory;
use App\Models\AppList;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Models\Module;
Use App\Models\Admin;
use Illuminate\Support\Facades\Validator;
use App\Models\Prayer;
use App\Models\MappedAppCategory;
use App\Helpers\LogActivity;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Yajra\DataTables\Facades\DataTables;

// app/Http/Controllers/BatchController.php
class BatchController extends Controller
{
    public function index(Request $request)
    {
        if (!has_permission('batch_menu', 'read')) {
            abort(403);
        }
        if (!has_module_access('batch_menu')) {
            abort(403);
        }

        if($request->ajax()){
            $batches = Batch::with('tree', 'startingPoint')
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'data' => $batches
            ]);
        }

        return view('admin.batch.index');
    }

    public function yajra(Request $request)
    {
        if (!has_permission('batch_menu', 'read')) {
            abort(403);
        }
        if (!has_module_access('batch_menu')) {
            abort(403);
        }

        if ($request->ajax()) {
            $categories = Batch::with('tree', 'startingPoint','apps')
                ->orderBy('created_at', 'desc')
                ->get();

            return DataTables::of($categories)
                ->addIndexColumn()
                ->addColumn('tree_structure', function($batch) {
                    $nodes = json_decode($batch->selected_nodes, true);
                    return $nodes; // Return raw nodes data
                })
                ->editColumn('created_at', function ($row) {
                    return date('Y-m-d', strtotime($row->created_at));
                })
                ->addColumn('status', function ($row) {
                    return $row->is_active == '0'
                        ? '<span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Active</span>'
                        : '<span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i> Deactivate</span>';
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group" role="group">
                        <form action="' . url('admin/edit_batch/' . $row->id) . '" method="POST" style="padding-left:5px;">
                            ' . csrf_field() . '
                            <button type="submit" class="btn btn-icon btn-circle btn-sm btn-outline-primary"
                                style="background: #012970cf; border-color:#012970cf; color:#ffffff !important;">
                                <i class="fa fa-edit"></i>
                            </button>
                        </form>
                        <form id="form_submit_' . $row->id . '" action="' . url('admin/delete_batch/' . $row->id) . '" method="POST" style="padding-left:5px;">
                            ' . csrf_field() . '
                            <button type="button" class="btn btn-icon btn-circle btn-sm btn-outline-danger"
                                onclick="return validateform(' . $row->id . ')"
                                style="background: #EE4B2B; border-color:#EE4B2B; color:#ffffff !important">
                                <i class="fa fa-trash-can-arrow-up"></i>
                            </button>
                        </form>
                    </div>';
                })
                ->addColumn('active', function ($row) {
                    return '<form action="' . url('admin/batch_status_update') . '" method="POST">
                        ' . csrf_field() . '
                        <input type="hidden" name="batch_id" value="' . $row->id . '">
                        <input type="hidden" name="status" value="' . $row->is_active . '">
                        <button type="submit" class="btn_status btn btn-success btn-sm"
                            style="background:' . ($row->is_active == '0' ? '#28a745' : '#ffad46') . '!important;border-color: ' . ($row->is_active == '0' ? '#28a745' : '#ffad46') . '!important;color: #fff!important;">
                            <i class="' . ($row->is_active == '0' ? 'fa-solid fa-circle' : 'fa-solid fa-ban') . '"></i>
                        </button>
                    </form>';
                })
                ->rawColumns(['tree_structure','status', 'action', 'active','created_at'])
                ->make(true);
        }
    }


    public function edit($id)
    {
        if (!has_permission('batch_menu', 'update')) {
            abort(403);
        }
        if (!has_module_access('batch_menu')) {
            abort(403);
        }

        $edit = Batch::findOrFail($id);
        return view('admin.batch.edit_batch_list', ['edit'=> $edit]);

    }

    public function store(Request $request)
    {
        if (!has_permission('batch_menu', 'create')) {
            abort(403);
        }
        if (!has_module_access('batch_menu')) {
            abort(403);
        }

        // Validate the request
        $validated = $request->validate([
            'app_name' => 'required|string',
            'batches' => 'required|array',
            'batches.*.tree_id' => 'required|integer',
            'batches.*.tree_name' => 'required|string',
            'batches.*.starting_point_id' => 'required|integer',
            'batches.*.starting_point_name' => 'required|string',
            'batches.*.selected_nodes' => 'required|array',
            'batches.*.selection_order' => 'required|integer',
        ]);

        // Validate the app_name
        $appName = $validated['app_name'];
        $app = AppList::where('app_name', $appName)->first();
        if ($app) {
            // get the app id
            $appId = $app->id;
        } else {
            //create app
            $app = AppList::create([
                'app_name' => $appName,
                'created_by' => auth()->user()->id,
            ]);
            // get the app id
            $appId = $app->id;
        }
        // Check if the app_id is valid
        if (!$appId) {
            return response()->json([
                'message' => 'Invalid app_id',
            ], 404);
        }

        // Check if the batches are valid
        $savedBatches = [];

        foreach ($validated['batches'] as $batchData) {
            // Convert node_id values to integers
            $nodeIds = array_map(fn($node) => (int) $node['node_id'], $batchData['selected_nodes']);

            // Get all descendant node IDs of the starting_point_id
            $childNodeIds = $this->getAllChildNodeIds([$batchData['starting_point_id']]);

            // Filter nodeIds to keep only those that are valid descendant nodes
            $filteredNodeIds = array_intersect($nodeIds, $childNodeIds);

            $batch = Batch::create([
                'app_id' => $appId,
                'tree_id' => $batchData['tree_id'],
                'tree_name' => $batchData['tree_name'],
                'starting_point_id' => $batchData['starting_point_id'],
                'starting_point_name' => $batchData['starting_point_name'],
                'selected_nodes' => json_encode($batchData['selected_nodes']),
                'selection_order' => $batchData['selection_order'],
                'selected_ids' => json_encode(array_values($filteredNodeIds)), // Reset array keys
            ]);

            $savedBatches[] = $batch;
        }
        LogActivity::addToLog();

        return response()->json([
            'message' => 'Batches saved successfully!... ',
            'data' => $savedBatches
        ], 201);
    }

    public function show(Batch $batch)
    {
        if (!has_permission('batch_menu', 'read')) {
            abort(403);
        }
        if (!has_module_access('batch_menu')) {
            abort(403);
        }

        return response()->json([
            'data' => $batch
        ]);
    }

    public function destroy(Batch $batch)
    {
        if (!has_permission('batch_menu', 'delete')) {
            abort(403);
        }
        if (!has_module_access('batch_menu')) {
            abort(403);
        }

        $batch->delete();
        LogActivity::addToLog();

        return response()->json([
            'message' => 'Batch deleted successfully'
        ]);
    }

    public function update(Request $request, Batch $batch)
    {
        if (!has_permission('batch_menu', 'update')) {
            abort(403);
        }
        if (!has_module_access('batch_menu')) {
            abort(403);
        }

        // Validate the request
        $validated = $request->validate([
            'tree_id' => 'required|integer',
            'tree_name' => 'required|string',
            'starting_point_id' => 'required|integer',
            'starting_point_name' => 'required|string',
            'selected_nodes' => 'required|array',
        ]);

        // Convert node_id values to integers
        $nodeIds = array_map(fn($node) => (int) $node['node_id'], $validated['selected_nodes']);

        // Get all descendant node IDs of the starting_point_id
        $childNodeIds = $this->getAllChildNodeIds([$validated['starting_point_id']]);

        // Filter nodeIds to keep only those that are valid descendant nodes
        $filteredNodeIds = array_intersect($nodeIds, $childNodeIds);

        // Store the updated nodeIds array
        $batch->update([
            'tree_id' => $validated['tree_id'],
            'tree_name' => $validated['tree_name'],
            'starting_point_id' => $validated['starting_point_id'],
            'starting_point_name' => $validated['starting_point_name'],
            'selected_nodes' => json_encode($validated['selected_nodes']), // Store updated node IDs
            'selected_ids' => json_encode(array_values($filteredNodeIds)), // Reset array keys
        ]);
        LogActivity::addToLog();

        return response()->json([
            'message' => 'Batch updated successfully',
            'data' => $batch
        ]);
    }

    /**
     * Recursively fetch all descendant node IDs
     */
    private function getAllChildNodeIds(array $parentIds)
    {
        $childNodeIds = NestedCategory::whereIn('parent_id', $parentIds)->pluck('id')->toArray();

        if (!empty($childNodeIds)) {
            return array_merge($childNodeIds, $this->getAllChildNodeIds($childNodeIds));
        }

        return $childNodeIds;
    }

    function add()
    {
        if (!has_permission('batch_menu', 'create')) {
            abort(403);
        }
        if (!has_module_access('batch_menu')) {
            abort(403);
        }

        $apps = AppList::where('deleted_at','0')->get();
        return view('admin.batch.add_batch', compact('apps'));
    }


    public function active(Request $request)
    {
        if (!has_permission('batch_menu', 'status')) {
            abort(403);
        }
        if (!has_module_access('batch_menu')) {
            abort(403);
        }
        LogActivity::addToLog();
        $parent_id = $request->batch_id;
        $status = $request->status;
        if($status == 0)
        {
            $app_active = Batch::find($parent_id);
            $app_active->is_active ='1';
            $app_active->save();
            return back()->with('message','Batch Disabled Successfully');
        }
        if($status == 1)
        {
            $app_active = Batch::find($parent_id);
            $app_active->is_active ='0';
            $app_active->save();
            return back()->with('message','Batch Enabled Successfully');
        }

    }

    public function delete(Request $request, $id)
    {
        if (!has_permission('batch_menu', 'delete')) {
            abort(403);
        }
        if (!has_module_access('batch_menu')) {
            abort(403);
        }

        Batch::find($id)->delete();
        LogActivity::addToLog();
        return back()->with('message','Batch Deleted Successfully');
    }

}


