<!DOCTYPE html>
<html>
    <head>
        <style type="text/css">
            p, h1 {
                text-align: center;
                margin: 5px;
            }
            div.container {
                display: block;
                margin: 20px auto;
                padding: 10px;
                background: cornsilk;
            }
            input.delete {
                background: #ff5500;
                margin: 5px auto;
                box-shadow: blue inset;
                box-sizing: content-box;
                display: inline-block;
                padding: 6px 12px;
                font-size: 14px;
                font-weight: 400;
                line-height: 1.42857143;
                text-align: center;
                white-space: nowrap;
                vertical-align: middle;
                cursor: pointer;
                border: 1px solid transparent;
                border-radius: 4px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Thank you</h1>
            <p>Thank you for subscribing to our weekly parenting tips and baby facts.</p>
            <p>If you did not initiate this action click the button below the unsubscribe.</p>
            {{ Form::open(['action' => ['Visitors\PublicController@destroySubscriber', encrypt($subscriber->id)], 'method' => "POST"]) }}
            {{ method_field('DELETE') }}
            {{ Form::submit('Unsubscribe', ['class' => 'delete btn btn-sm btn-danger']) }}
            {{ Form::close() }}
        </div>
    </body>
</html>