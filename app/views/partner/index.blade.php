<html>
    <body>
        <table>
            <tr >
               
                <td><b>Ten Partner</b></td>
                <td><b>SUA</b></td>
                <td><b>XOA</b></td>
            </tr>
            @foreach($data as $key => $value)
            <tr >
                <td>{{ $value->partner_name }}</td>
                <td>
                	<a href="{{action('PartnerController@edit', $value->id)}}">Sua</a>
                	
                </td>
                <td>
                	{{ Form::open(array('method'=>'DELETE', 'action' => array('PartnerController@destroy', $value->id), 'style' => 'display: inline-block;')) }}
                    <button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</button>
                    {{ Form::close() }}
                </td>
            </tr>

           
            @endforeach
             
        </table>
    </body>
</html>