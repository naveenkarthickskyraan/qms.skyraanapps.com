<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="{{ asset('assets/img/Proposed.jpg')}}" rel="icon">

<title>Quiz Info - Version 1 [Dev-APIs] - Webservice Form</title>

<style type="text/css">
    body {
        font-size: 16px;
        color: black;
    }

    td {
        padding-top: 5px;
        padding-left: 5px;
    }
</style>


</head>

<body>
    <h1 class="page-title" style="color:#012970 !important">Quiz Info API SET 5 - Version 1 [Dev-APIs] - Webservice
        Form - Last Update (11-04-2025)</h1>
    <br>

    <fieldset style="border:2px solid; border-color:#012970">
            <form name="form" method="GET" action="{{url('/api/app_list_api')}}">
            @csrf
            <input type="hidden" name="_token" value="poyVeWVAWoGXuKZxeCgQYlaYdOvUxCoQKczaj36T">
            <table  border="0" width="100%">
            <tr>
                <td height="30" colspan="2" align="left"> <strong style="text-decoration:underline;color:#F00;"> 1 . App List [ Development Mode ] </strong><br>
                    <div><strong>API URL:</strong> {{ url('/api/app_list_api')}}</div>
                    <div><strong>Method:</strong> GET </div>
                    <div><strong>Content-Type:</strong> application/x-www-form-urlencoded [i.e. x-www-form-urlencoded]</div>
                    <div><strong>API Mode:</strong> Development </div>
                    <div><strong>Notes:</strong> Last Modified at : 06-Oct-2022 </div>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <table width="100%" border="0" cellspacing="2" cellpadding="2">
                        <tr style="background-color:#012970;  color:#FFF;">
                            <td><strong>Label Name</strong></td>
                            <td><strong>Value</strong></td>
                            <td><strong>Variable Name</strong></td>
                            <td><strong>Mandatory</strong></td>
                            <td><strong>Note</strong></td>
                            <td><strong>Sample</strong></td>
                        </tr>
                        <tr>
                            <td colspan="1" align="center"><input type="submit" value="Submit"/></td>
                        </tr>

                    </table>
                </td>
            </tr>
            </table>
        </form>
    </fieldset>
    <br><br>


    <fieldset style="border:2px solid; border-color:#012970">
        <form method="POST" action="{{ url('api/get_categories_using_app_id_and_category_id') }}">
            @csrf
            <table border="0" width="100%">
                <tr>
                    <td height="30" colspan="2" align="left">
                        <strong style="text-decoration:underline;color:#F00;">2 . Get Categories Info Using App ID and Category ID [Development Mode]</strong><br>
                        <div><strong>API URL:</strong> {{ url('api/get_categories_using_app_id_and_category_id') }}</div>
                        <div><strong>Method:</strong> POST</div>
                        <div><strong>Content-Type:</strong> application/x-www-form-urlencoded [i.e.
                            x-www-form-urlencoded]</div>
                        <div><strong>API Mode:</strong> Development</div>
                        <div><strong>Notes:</strong> Last Modified at: <span style="color:#012970;">05-AUGUST-2024</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <table width="100%" border="0" cellspacing="2" cellpadding="2">
                            <tr style="background-color:#012970;  color:#FFF;">
                                <td><strong>Label Name</strong></td>
                                <td><strong>Value</strong></td>
                                <td><strong>Variable Name</strong></td>
                                <td><strong>Mandatory</strong></td>
                                <td><strong>Note</strong></td>
                                <td><strong>Sample</strong></td>
                            </tr>

                            <tr>
                                <td>App ID</td>
                                <td><input type="text" name="app_id" /></td>
                                <td>app_id</td>
                                <td>Yes</td>
                                <td>From Apps Table Get list from GetAppInfo API</td>
                                <td>1 (string)</td>
                            </tr>

                            <tr>
                                <td>Batch Id</td>
                                <td><input type="text" name="batch_id" /></td>
                                <td>batch_id</td>
                                <td>Yes</td>
                                <td>Initially, set the value to 0. If ViewMoreCategoriesStatus is 1, update batch_id with its value.</td>
                                <td>1 (string)</td>
                            </tr>

                            <tr>
                                <td>Category ID</td>
                                <td><input type="text" name="category_id" /></td>
                                <td>category_id</td>
                                <td>Yes</td>
                                <td>From Category Table Get list from Nested Category List</td>
                                <td>1 (string)</td>
                            </tr>
                            <tr>
                                <td colspan="1" align="center"><input type="submit" value="submit" /></td>
                            </tr>

                        </table>
                    </td>
                </tr>
            </table>
        </form>
    </fieldset>
    <br><br>

    <fieldset style="border:2px solid; border-color:#012970">
        <form method="POST" action="{{ url('api/get_questions_using_category_id') }}">
            @csrf
            <table border="0" width="100%">
                <tr>
                    <td height="30" colspan="2" align="left">
                        <strong style="text-decoration:underline;color:#F00;">3 . Get Questions Info Using Category ID [Development Mode]</strong><br>
                        <div><strong>API URL:</strong> {{ url('api/get_questions_using_category_id') }}</div>
                        <div><strong>Method:</strong> POST</div>
                        <div><strong>Content-Type:</strong> application/x-www-form-urlencoded [i.e.
                            x-www-form-urlencoded]</div>
                        <div><strong>API Mode:</strong> Development</div>
                        <div><strong>Notes:</strong> Last Modified at: <span style="color:#012970;">05-AUGUST-2024</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <table width="100%" border="0" cellspacing="2" cellpadding="2">
                            <tr style="background-color:#012970;  color:#FFF;">
                                <td><strong>Label Name</strong></td>
                                <td><strong>Value</strong></td>
                                <td><strong>Variable Name</strong></td>
                                <td><strong>Mandatory</strong></td>
                                <td><strong>Note</strong></td>
                                <td><strong>Sample</strong></td>
                            </tr>

                            <tr>
                                <td>Category ID</td>
                                <td><input type="text" name="category_id" /></td>
                                <td>category_id</td>
                                <td>Yes</td>
                                <td>From Category Table Get list from Nested Category List</td>
                                <td>1 (string)</td>
                            </tr>

                            <tr>
                                <td>Page Number</td>
                                <td><input type="text" name="page"/></td>
                                <td>page</td>
                                <td>No</td>
                                <td>From the Pagination for search</td>
                                <td>1 or 2 (string)</td>
                            </tr>

                            <tr>
                                <td colspan="1" align="center"><input type="submit" value="submit" /></td>
                            </tr>

                        </table>
                    </td>
                </tr>
            </table>
        </form>
    </fieldset>
    <br><br>


    <fieldset style="border:2px solid; border-color:#012970">
        <form method="POST" action="{{ url('api/get_questions_search_using_app_id') }}">
            @csrf
            <table border="0" width="100%">
                <tr>
                    <td height="30" colspan="2" align="left">
                        <strong style="text-decoration:underline;color:#F00;">4 . Search Questions Info Using App ID [Development Mode]</strong><br>
                        <div><strong>API URL:</strong> {{ url('api/get_questions_search_using_app_id') }}</div>
                        <div><strong>Method:</strong> POST</div>
                        <div><strong>Content-Type:</strong> application/x-www-form-urlencoded [i.e.
                            x-www-form-urlencoded]</div>
                        <div><strong>API Mode:</strong> Development</div>
                        <div><strong>Notes:</strong> Last Modified at: <span style="color:#012970;">05-AUGUST-2024</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <table width="100%" border="0" cellspacing="2" cellpadding="2">
                            <tr style="background-color:#012970;  color:#FFF;">
                                <td><strong>Label Name</strong></td>
                                <td><strong>Value</strong></td>
                                <td><strong>Variable Name</strong></td>
                                <td><strong>Mandatory</strong></td>
                                <td><strong>Note</strong></td>
                                <td><strong>Sample</strong></td>
                            </tr>

                            <tr>
                                <td>Search </td>
                                <td><input type="text" name="search" /></td>
                                <td>search</td>
                                <td>Yes</td>
                                <td>From Questions Table </td>
                                <td>abc (string)</td>
                            </tr>

                            <tr>
                                <td>App ID</td>
                                <td><input type="text" name="app_id" /></td>
                                <td>app_id</td>
                                <td>Yes</td>
                                <td>From Apps Table</td>
                                <td>1 (string)</td>
                            </tr>

                            <tr>
                                <td colspan="1" align="center"><input type="submit" value="submit" /></td>
                            </tr>

                        </table>
                    </td>
                </tr>
            </table>
        </form>
    </fieldset>
    <br><br>


    <fieldset style="border:2px solid; border-color:#012970">
        <form method="POST" action="{{ url('api/get_questions_detail') }}">
            @csrf
            <table border="0" width="100%">
                <tr>
                    <td height="30" colspan="2" align="left">
                        <strong style="text-decoration:underline;color:#F00;">5 . Get Questions Info Using Question ID [Development Mode]</strong><br>
                        <div><strong>API URL:</strong> {{ url('api/get_questions_detail') }}</div>
                        <div><strong>Method:</strong> POST</div>
                        <div><strong>Content-Type:</strong> application/x-www-form-urlencoded [i.e.
                            x-www-form-urlencoded]</div>
                        <div><strong>API Mode:</strong> Development</div>
                        <div><strong>Notes:</strong> Last Modified at: <span style="color:#012970;">05-AUGUST-2024</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <table width="100%" border="0" cellspacing="2" cellpadding="2">
                            <tr style="background-color:#012970;  color:#FFF;">
                                <td><strong>Label Name</strong></td>
                                <td><strong>Value</strong></td>
                                <td><strong>Variable Name</strong></td>
                                <td><strong>Mandatory</strong></td>
                                <td><strong>Note</strong></td>
                                <td><strong>Sample</strong></td>
                            </tr>
                            <tr>
                                <td>Question ID</td>
                                <td><input type="text" name="quiz_id" /></td>
                                <td>quiz_id</td>
                                <td>Yes</td>
                                <td>From Questions Table </td>
                                <td>1 (string)</td>
                            <tr>

                            <tr>
                                <td colspan="1" align="center"><input type="submit" value="submit" /></td>
                            </tr>

                        </table>
                    </td>
                </tr>
            </table>
        </form>
    </fieldset>
    <br><br>



    <fieldset style="border:2px solid; border-color:#012970">
        <form method="POST" action="{{ url('api/get_last_fetched_questions_using_quiz_id') }}">
            @csrf
            <table border="0" width="100%">
                <tr>
                    <td height="30" colspan="2" align="left">
                        <strong style="text-decoration:underline;color:#F00;">6 . Get Last Fetched Questions Info Using Question ID [Development Mode]</strong><br>
                        <div><strong>API URL:</strong> {{ url('api/get_last_fetched_questions_using_quiz_id') }}</div>
                        <div><strong>Method:</strong> POST</div>
                        <div><strong>Content-Type:</strong> application/x-www-form-urlencoded [i.e.
                            x-www-form-urlencoded]</div>
                        <div><strong>API Mode:</strong> Development</div>
                        <div><strong>Notes:</strong> Last Modified at: <span style="color:#012970;">05-AUGUST-2024</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <table width="100%" border="0" cellspacing="2" cellpadding="2">
                            <tr style="background-color:#012970;  color:#FFF;">
                                <td><strong>Label Name</strong></td>
                                <td><strong>Value</strong></td>
                                <td><strong>Variable Name</strong></td>
                                <td><strong>Mandatory</strong></td>
                                <td><strong>Note</strong></td>
                                <td><strong>Sample</strong></td>
                            </tr>

                            <tr>
                                <td>app_id</td>
                                <td><input type="text" name="app_id"/></td>
                                <td>app_id</td>
                                <td>Yes</td>
                                <td>From App List API (app_id)  </td>
                                <td>1 (string)</td>
                            </tr>

                            <tr>
                                <td>Category ID</td>
                                <td><input type="text" name="category_id" /></td>
                                <td>category_id</td>
                                <td>Yes</td>
                                <td>From Category Table Get list from Nested Category List</td>
                                <td>1 (string)</td>
                            <tr>
                                <td>Question ID</td>
                                <td><input type="text" name="quiz_id" /></td>
                                <td>quiz_id</td>
                                <td>Yes</td>
                                <td>From Questions Table </td>
                                <td>1 (string)</td>
                            <tr>

                            <tr>
                                <td colspan="1" align="center"><input type="submit" value="submit" /></td>
                            </tr>

                        </table>
                    </td>
                </tr>
            </table>
        </form>
    </fieldset>
    <br><br>
    
    
    <fieldset style="border:2px solid; border-color:#012970">
        <form method="POST" action="{{ url('api/get_direction_based_questions_using_category_id') }}">
            @csrf
            <table border="0" width="100%">
                <tr>
                    <td height="30" colspan="2" align="left">
                        <strong style="text-decoration:underline;color:#F00;">7 . Get Direction based Questions Info Using Category ID [Development Mode]</strong><br>
                        <div><strong>API URL:</strong> {{ url('api/get_direction_based_questions_using_category_id') }}</div>
                        <div><strong>Method:</strong> POST</div>
                        <div><strong>Content-Type:</strong> application/x-www-form-urlencoded [i.e.
                            x-www-form-urlencoded]</div>
                        <div><strong>API Mode:</strong> Development</div>
                        <div><strong>Notes:</strong> Last Modified at: <span style="color:#012970;">05-AUGUST-2024</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <table width="100%" border="0" cellspacing="2" cellpadding="2">
                            <tr style="background-color:#012970;  color:#FFF;">
                                <td><strong>Label Name</strong></td>
                                <td><strong>Value</strong></td>
                                <td><strong>Variable Name</strong></td>
                                <td><strong>Mandatory</strong></td>
                                <td><strong>Note</strong></td>
                                <td><strong>Sample</strong></td>
                            </tr>

                            <tr>
                                <td>Category ID</td>
                                <td><input type="text" name="category_id" /></td>
                                <td>category_id</td>
                                <td>Yes</td>
                                <td>From Category Table Get list from Nested Category List</td>
                                <td>1 (string)</td>
                            </tr>

                            <tr>
                                <td>Page Number</td>
                                <td><input type="text" name="page"/></td>
                                <td>page</td>
                                <td>No</td>
                                <td>From the Pagination for search</td>
                                <td>1 or 2 (string)</td>
                            </tr>

                            <tr>
                                <td colspan="1" align="center"><input type="submit" value="submit" /></td>
                            </tr>

                        </table>
                    </td>
                </tr>
            </table>
        </form>
    </fieldset>
    <br><br>

</body>

</html>
