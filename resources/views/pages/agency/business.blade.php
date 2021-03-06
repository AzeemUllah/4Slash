@extends('pages.agency.agency_template')
<style>
    .back-white{
        background-color: white;
    }
    @media(max-width: 767px){
        .border-class{
            display: none;
        }
    }
</style>

@section('header_title')

    <h1 style="padding: 0px 10px;">Business Modell</h1>

@endsection

@section('content')
    <div class="row" style="margin-left: 0px; margin-right: 0px;">
        @include('pages.agency.partials.side_menue')
        <div class="col-md-9 col-sm-12 col-xs-12 back-white">
            <div class="col-sm-5 col-xs-12 text-justify" style="padding: 10px 0px;">
                <h4><b>Partner Modell– CNERR Partner – Germany</b></h4>
                <p><u>Allgemeines</u><span style="margin-left: 20px;"><img src="{{ url('/') }}/img/ger_flag.png" alt=""
                                                                           width="100px;" style="height:54px;"></span>
                </p>
                <p>Das Unternehmen <b>Cnerr.de</b> verkauft unter dem Marktplatz cnerr.de kleine und große Dienstleistungen
                    rund um den digitalen, kreativen Markt. <b>cnerr.de</b> arbeitet ausschließlich mit ausgewählten und
                    geprüften Partnern zusammen. Partner des großen cnerr.de – Netzwerkes genießen die Vorteile in einem
                    interessanten Markt gemeinsam unter der Marke <b>CNERR</b> tätig zu werden. Das Unternehmen Cnerr.de
                    betreut die eigenen Kunden mit einem professionellen Support-Team, die im Bereich First-Level und
                    Call-Agent-Support, die Qualität, die man in Deutschland erwartet, gewährleistet. Aus diesem Grund
                    arbeiten die Partner im Hintergrund und liefern die erstellen Arbeiten direkt an den Vertrieb des
                    Unternehmens <b>Cnerr.de</b>. Wir steuern die Korrespondenz, die Qualitätssicherung und die Freigabe an
                    unseren Kunden und sind mit unseren Partnern im direkten Dialog. Unsere Partner sind uns sehr
                    wichtig.
                </p>
                <p>Mehr als bei internationalen Plattformen rechnen wir in einer starken Währung, dem Euro € ab. Die
                    Aufteilung des Warenkorbes garantiert eine Partnerschaft auf Augenhöhe. Unsere Partner erhalten 85%
                    des Warenkorbs unserer Kunden. Wir zahlen mehr als vergleichbare internationale Plattformen. Der
                    Partner garantiert Auftragsarbeiten in bester Qualität, Cnerr.de garantiert eine reibungslose
                    Abwicklung und Kommunikation nach europäischen und deutschen Standards</p>
                <p><b>Vorteile für Partner</b></p>
                <ul>
                    <li>Partner von Cnerr.de sind exklusiv mit eigenem Favor Angebot im Netzwerk.</li>
                    <li>Nur wenige Partner benötigen wir in unserem Netzwerk um eine große Auslastung zu
                        gewährleisten.
                    </li>
                    <li>Die Abrechnung wird wöchentlich automatisiert durchgeführt.</li>
                    <li>Keine Kommunikation durch die Partner mit unseren deutschsprachigen Kunden.</li>
                    <li>Mit den Erweiterungen wird der Warenkorb schnell mit Produkten erweitert werden, da wir in
                        Deutschland mehr Umsätze durch den Qualitätsanspruch gewinnen können.
                    </li>
                </ul>
            </div>
            <div class="col-sm-2 col-xs-12 text-center border-class" style="padding-top: 25px;"><span
                        style="border-right: 2px solid #c5c5c5; height: 148%; display: inline-block;"></span></div>
            <div class="col-sm-5 col-xs-12 text-justify" style="padding: 10px 0px;">
                <h4><b>Business model CNERR partners – Germany</b></h4>
                <p><u>General remarks</u><span style="margin-left: 20px;"><img src="{{ url('/') }}/img/eng_flag.png"
                                                                               alt=""
                                                                               width="100px;"></span></p>
                <p>The company <b>Cnerr.de</b> sells small and major services of the digital, creative market via its
                    market place <b><a style="color: black;"
                                href="https://www.cnerr.de">cnerr.de</a></b>. <b><a style="color: black;"
                                href="https://www.cnerr.de">cnerr.de</a></b> only works with selected and verified
                    partners. Partners of the large
                    <a href="https://www.cnerr.de">cnerr.de</a> network benefit from being part of an interesting market
                    together with the <b>CNERR</b> brand.</p>
                <p><b>Cnerr.de</b> supports its own customers by means of a professional support team in first-level and
                    call-agent support which ensures the quality expected in Germany. This is why partners work in the
                    background supplying the produced work directly to the sales and distribution department of <b>Cnerr
                        UG</b>.</p>
                <p>We manage correspondence, control quality assurance and clearance to our customers and we maintain a
                    direct dialog with our partners. Our partners are very important to us. Therefore we have adapted
                    the business model so that all work, in this case, the content of the shopping cart is divided like
                    this: 60% for the agency, 40% for cnerr.de.</p>
                <p><b><u>Compared to other competitors, Cnerr distributes at least 36.5% more for the same service. The
                            agency earns at least $5.35 without add-ons.</u></b></p>
                            <p><b><u>Cnerr also undertakes the whole processing and correspondence with the German customers.</u></b>
                </p>
                <p>Unlike international platforms, we calculate in a strong currency, the euro €. The allocation of the
                    content of the shopping cart guarantees partnership on an equal footing. The partner guarantees
                    commissioned work at top quality, Cnerr.de guarantees smooth processing and communication according
                    to European and German standards</p>
                <ul>
                    <li>Partners of cnerr.de are exclusively part of the network with their own favor offers.</li>
                    <li>We only need few partners in our network to guarantee a great utilization.</li>
                    <li>Accounting automatically once a week.</li>
                    <li>No communication for partners with our German customers.</li>
                    <li>The add-ons will quickly expand the shopping cart with products, since we can gain more sales in
                        Germany by means of quality standards.
                    </li>
                </ul>
            </div>
        </div>
    </div><!-- /.row -->



@endsection