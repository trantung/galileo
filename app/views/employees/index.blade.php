<html>
    <body>
        <table>
            <tr >
               
                <td><b>Ten Center</b></td>
                <td><b>Ten Employees</b></td>
                <td><b>SUA</b></td>
                <td><b>XOA</b></td>
            </tr>
            @foreach($data as $key => $value)
            <tr >
                <td>{{ Common::getObject($value->center, 'center_name') }}</td>   
                <td>{{ $value->employees_name }}</td>
                <td>
                	<a href="{{action('CenterController@edit', $value->id)}}">Sua</a>
                	
                </td>
                <td>
                	{{ Form::open(array('method'=>'DELETE', 'action' => array('CenterController@destroy', $value->id), 'style' => 'display: inline-block;')) }}
                    <button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</button>
                    {{ Form::close() }}
                </td>
            </tr>

           
            @endforeach
             
        </table>
    </body>
</html>