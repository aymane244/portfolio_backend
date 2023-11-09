
<style>
    .container{
        font-family: "Trebuchet MS", Tahoma, sans-serif;
    }
    .quote_padding{
        padding-top: 10px;
    }
    .float_div{
        float: right;
    }
</style>
<div class="container">
    <div class="float_div">
        <h1 style="color: #5a62cd; margin-left: 50px">QUOTE</h1>
        <table cellspacing="0">
            <tr>
                <td style="padding-right: 15px; padding-left: 18px;">DATE</td>
                <td style="border: 1.8px solid rgb(156, 156, 156); padding-left: 10px; padding-right: 10px; text-align:center">{{ date('d/m/Y') }}</td>
            </tr>
            <tr>
                <td style="padding-right: 15px;">Quote #</td>
                <td style="border: 1.8px solid rgb(156, 156, 156); border-top: 0; padding-left: 10px; padding-right: 10px; text-align:center; margin-top: -10px">{{ $quote }}</td>
            </tr>
        </table>
    </div>
    <div>
        <p>
            <span style="color: #0e005c; font-size: 30px">AIMANE CHNAIF</span><br>
            <span style="padding-left: 15px; padding-top: 10px;">Lot Riad Ahlan 424</span><br>
            <span style="padding-left: 15px">Tangier, 90000, Morocco</span><br>
            <span style="padding-left: 15px">Phone: +212644776612</span><br>
            <span style="padding-left: 15px">Email: a.chnaif2010@gmail.com</span><br>
        </p>
        <div class="quote_padding">
            <div style="background-color: #2c35b7; width: 40%; color: white; padding-left: 15px; padding-bottom: 2px;">Quote for</div>
            <div style="padding-left: 15px; padding-top: 5px;">{{ $client_name === "undefined undefined" ? "Visitor" : $client_name }}</div>
            <div style="padding-left: 15px; padding-top: 5px;">{{ $email }}</div>
            <div style="padding-left: 15px; padding-top: 5px;">{{ $phone }}</div>
        </div>
    </div>
    <div style="padding-top: 100px">
        <table style="width: 100%; border: 1.7px solid black">
            <thead>
                <tr style="background-color: #2c35b7; color: white;">
                    <th style="width: 80%">SERVICE DESCRIPTION</th>
                    <th style="width: 20%;">PRICE</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Service</strong></td>
                    <th style="width: 20%;">{{ $initial_price }},00 USD</th>
                </tr>
                <tr>
                    <td style="padding-left: 10px">{{ $main_service }}</td>
                </tr>
                @if($page_number > 0)
                    <tr>
                        <td><strong>Pages</strong></td>
                        <th>{{ $page_number * $page_price }},00 USD</th>
                    </tr>
                    <tr>
                        <td style="padding-left: 10px">
                            {{ $page_number > 1  ? $page_number." Pages" : $page_number." Page" }} 
                            ({{ $page_price }} USD/Page)
                        </td>
                    </tr>
                @endif
                @if(strlen($functionalities[0]->service) > 0 || strlen($functionalities[1]->service) > 0 || strlen($functionalities[2]->service) > 0 ||
                    strlen($functionalities[3]->service) > 0 || strlen($functionalities[4]->service) > 0 || strlen($functionalities[5]->service) > 0 &&
                    $functionalities[5]->type !== "other"
                )
                    <tr>
                        <td><strong>Functionalities</strong></td>
                        <th>{{ $sum }},00 USD</th>
                    </tr>
                    @foreach($functionalities as $functionality)
                        @if($functionality->type !== "other" && $functionality->servicePrice > 0)
                            <tr>
                                <td style="padding-left: 10px">
                                    {{$functionality->service}}
                                    ({{$functionality->servicePrice}} USD)
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @endif
                @if(strlen($languages[0]->languageSelect) > 0)
                    <tr>
                        <td><strong>Languages choosen</strong></td>
                    </tr>
                    @foreach($languages as $language)
                        <tr>
                            <td style="padding-left: 10px">
                                {{$language->languageSelect}}
                                (150 USD)
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <div class="float_div">
            <table style="width: 100%; padding-right:30px">
                <tr>
                    <td style="width: 80%; padding-right:40px"><strong>SUB-TOTAL</strong></td>
                    <td style="width: 20%;"><strong>{{ $initial_price + $sum + ($page_number * $page_price) }},00 USD</strong></td>
                </tr>
                <tr>
                    <td style="width: 80%; padding-right:40px"><strong>TAX DUE</strong></td>
                    <td style="width: 20%;"><strong>0,00 USD</strong></td>
                </tr>
                <tr>
                    <td style="width: 80%; padding-right:40px"><strong>TOTAL</strong></td>
                    <td style="width: 20%;"><strong>{{ $initial_price + $sum + ($page_number * $page_price) }},00 USD</strong></td>
                </tr>
            </table>
        </div>
    </div>
    <div style="padding-top:100px;">
        <table style="width: 50%;" cellspacing="0">
            <tr>
                <td style="background-color: #2c35b7; width: 50%; color: white; padding-left: 15px; padding-bottom: 2px;">Comments</td>
            </tr>
            <tr style="border: 1.2px solid rgb(156, 156, 156); border-top: 0;">
                @foreach($functionalities as $functionality)
                    @if($functionality->type === "other")
                        <td style="padding-left: 15px;">
                            @if($other_service === null)
                                No comment
                            @else
                                {!! nl2br(e($other_service)) !!}
                            @endif
                        </td>
                    @endif
                @endforeach
            </tr>
        </table>
    </div>
    <div style="position:fixed; bottom:0; left : 44px; clear: right; text-align:center;">
        <hr>
        <div>Aimane Chnaif, +212644776612 ,a.chnaif2010@gmail.com, ICE: 003305634000007</div>
        <div><strong>Thank You For Your Business!</strong></div>
    </div>
</div>