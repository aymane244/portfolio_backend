<div style='background-color: #F8F9FA; font-family: Trebuchet MS; margin-top: 5px; margin-bottom: 5px; margin-right: 5px; margin-left: 5px; border-radius : 5px;'>
    <br/><br/>
    <h1 style='text-align:center'>
        A new service quote from {{$mailData['first_name'] === "undefined" ? "Visitor" : $mailData['first_name']}}
    </h1>
    <div style='font-size: 1.2rem; margin-right: 5px; margin-left: 5px; text-align:left'>
        <p>
            <strong>
                Email : {{$mailData['email']}} <br>
                Service : {{$mailData['service']}}
            </strong>
        </p>
    </div>
    <br/>
</div>