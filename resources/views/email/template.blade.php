<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{$subject}}</title>
    <style>
        body
        {
            font-family: Tahoma,Verdana,Arial,sans-serif;
            margin-top: 20px;
            font-size: 100%;
        }

        .clearfix
        {
            *zoom: 1;
        }

            .clearfix:before, .clearfix:after
            {
                display: table;
                line-height: 0;
                content: "";
            }

            .clearfix:after
            {
                clear: both;
            }

        .pull-right
        {
            float: right;
        }

        .pull-left
        {
            float: left;
        }

        #container
        {
            width: 600px;
            margin: 0 auto;
        }

        h5, h1
        {
            margin: 0;
            padding: 0;
            text-align: right;
            line-height: 1.2em;
            font-weight: 200;
        }

        p
        {
            font-size: 0.8em;
            text-align: justify;
        }

            p.footer
            {
                font-size: 0.7em;
                color: gray;
            }
    </style>
</head>
<body>
    <div id="container">
        <div id="logo" class="pull-left"></div>
        <div id="title" class="pull-right">
            <h5 class="subtitle">Marine Info Application</h5>
            
        </div>
        <div class="clearfix"></div>
        <div id="main">
            <p>Dear Mr/Mrs. {{ $target_name }}, </p>
            <br>
            {!! $body_message !!}
            <p>
                Best Regards,<br />
                <strong>Administrator for Marine Application<br />
                    Kementerian Perhubungan.</strong>
            </p>
            <p class="footer">
                This is an auto generated email. Please do not reply to this address.<br />
                For help &amp; support, please contact administrator at <a style="text-decoration: none;" href="mailto:administrator@mail.co.id">administrator@mail.co.id</a>
            </p>
            <p class="footer">
                Developed and Managed by Kementerian Perhubungan<br />
                Copyright 2016 Kementerian Perhubungan all rights reserved
            </p>
        </div>
    </div>
</body>
</html>
