<div style='background-color: #F8F9FA; font-family: Trebuchet MS; margin-top: 5px; margin-bottom: 5px; margin-right: 5px; margin-left: 5px; border-radius : 5px;'>
    <br/><br/>
    <h1 style='text-align:center'>Dear {{$mailData['first_name'] === "undefined" ? "Visitor" : $mailData['first_name']}}</h1>
    <div style='font-size: 1.2rem; margin-right: 5px; margin-left: 5px; text-align:left'>
        <p>
            <strong>
                @if($mailData['service'] === "Website Maintenance" || $mailData['service'] === "WordPress Plugin Creation")
                    Thank you for choosing Aymane Web-Dev for your web development services. I will carefully analyze the chosen service, 
                    "{{$mailData['service']}}" alongside your requirements <br/>"{{$mailData['rest_services']}}".<br/>
                    <br/>
                    And promptly return with the tailored quote that best fits your requirements.<br/>
                @else
                    Thank you for choosing Aymane Web-Dev for your web development services. You'll find attached your personalized quote. <br/> 
                @endif
                <br>
                If you have any questions or need further details, please don't hesitate to get in touch with me. <br>
                <br>
                Have a {{$mailData['greeting']}}
            </strong>
        </p>
    </div>
    <br/>
</div>