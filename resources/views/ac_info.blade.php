@extends('layouts.master')

@section('body-class', 'sections-page sidebar-collapse')

@section('nav-class', 'navbar navbar-expand-lg bg-primary fixed-top')

@section('content')

<div class="wrapper">
    <div class="section">
        <div class="blogs-1" id="blogs-1">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 ml-auto mr-auto">
                        <h2 class="title">Brands</h2>
                        <br />
                        <div class="card card-plain card-blog">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="card-image text-center">
                                        <img class="img img-raised rounded" src="{{ asset('assets/img/daikin.jpg') }}" />
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <h3 class="card-title">
                                        <a href="#pablo">Daikin</a>
                                    </h3>
                                    <p class="card-description text-justify">
                                        Daikin is known for their innovative and energy-efficient technologies, such as their inverter technology, which allows for precise control of the compressor speed and results in energy savings and quieter operation.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card card-plain card-blog">
                            <div class="row">
                                <div class="col-md-7">
                                    <h3 class="card-title">
                                        <a href="#pablo">Mitsubishi Electric</a>
                                    </h3>
                                    <p class="card-description text-justify">
                                        Mitsubishi Electric is known for their high-quality and reliable air conditioning systems, as well as their focus on energy efficiency and eco-friendliness.
                                    </p>
                                </div>
                                <div class="col-md-5">
                                    <div class="card-image text-center">
                                        <img class="img img-raised rounded" src="{{ asset('assets/img/mitsubishi-electric.jpg') }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-plain card-blog">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="card-image text-center">
                                        <img class="img img-raised rounded" src="{{ asset('assets/img/lg.jpeg') }}" />
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <h3 class="card-title">
                                        <a href="#pablo">LG</a>
                                    </h3>
                                    <p class="card-description text-justify">
                                        LG is known for their innovative and energy-efficient technologies, such as their inverter technology and smart controls, which can help to reduce energy consumption and improve indoor air quality.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card card-plain card-blog">
                            <div class="row">
                                <div class="col-md-7">
                                    <h3 class="card-title">
                                        <a href="#pablo">Carrier</a>
                                    </h3>
                                    <p class="card-description text-justify">
                                        Carrier is known for their advanced technologies, such as their Greenspeed Intelligence system, which allows for precise temperature control and energy savings, and their Puron refrigerant, which is an eco-friendly alternative to traditional refrigerants.
                                    </p>
                                </div>
                                <div class="col-md-5">
                                    <div class="card-image text-center">
                                        <img class="img img-raised rounded" src="{{ asset('assets/img/carrier.jpg') }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-plain card-blog">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="card-image text-center">
                                        <img class="img img-raised rounded" src="{{ asset('assets/img/panasonic.jpg') }}" />
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <h3 class="card-title">
                                        <a href="#pablo">Panasonic</a>
                                    </h3>
                                    <p class="card-description text-justify">
                                        Panasonic is known for their energy-efficient technologies, such as their inverter technology and ECONAVI sensors, which can help to reduce energy consumption and improve indoor air quality.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card card-plain card-blog">
                            <div class="row">
                                <div class="col-md-7">
                                    <h3 class="card-title">
                                        <a href="#pablo">Samsung</a>
                                    </h3>
                                    <p class="card-description text-justify">
                                        Samsung is known for their advanced technologies, such as their digital inverter technology, which allows for precise temperature control and energy savings, and their Wind-Free Cooling technology, which eliminates the uncomfortable feeling of direct cold air blowing onto the body.
                                    </p>
                                </div>
                                <div class="col-md-5">
                                    <div class="card-image text-center">
                                        <img class="img img-raised rounded" src="{{ asset('assets/img/samsung.jpg') }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-plain card-blog">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="card-image text-center">
                                        <img class="img img-raised rounded" src="{{ asset('assets/img/fujitsu.jpg') }}" />
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <h3 class="card-title">
                                        <a href="#pablo">Fujitsu</a>
                                    </h3>
                                    <p class="card-description text-justify">
                                        Fujitsu is known for their energy-efficient technologies, such as their inverter technology, which allows for precise temperature control and energy savings, and their Human Sensor technology, which detects human presence and adjusts the cooling output accordingly.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card card-plain card-blog">
                            <div class="row">
                                <div class="col-md-7">
                                    <h3 class="card-title">
                                        <a href="#pablo">Toshiba</a>
                                    </h3>
                                    <p class="card-description text-justify">
                                        Toshiba is known for their advanced technologies, such as their DC Hybrid Inverter technology, which allows for precise temperature control and energy savings, and their Plasma Ion Technology, which purifies the air by removing bacteria, viruses, and other allergens.
                                    </p>
                                </div>
                                <div class="col-md-5">
                                    <div class="card-image text-center">
                                        <img class="img img-raised rounded" src="{{ asset('assets/img/toshiba.jpg') }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-plain card-blog">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="card-image text-center">
                                        <img class="img img-raised rounded" src="{{ asset('assets/img/hitachi.jpg') }}" />
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <h3 class="card-title">
                                        <a href="#pablo">Hitachi</a>
                                    </h3>
                                    <p class="card-description text-justify">
                                        Hitachi is known for their advanced technologies, such as their inverter technology, which allows for precise temperature control and energy savings, and their Nano Titanium Filter, which captures bacteria and allergens.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="blogs-2" id="blogs-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 ml-auto mr-auto">
                        <h2 class="title">Types</h2>
                        <div class="row justify-content-center">
                            <div class="col-md-5">
                                <div class="card card-plain card-blog">
                                    <div class="card-image">
                                        <img class="img img-raised rounded" src="{{ asset('assets/img/window.png') }}" />
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            Window
                                        </h5>
                                        <p class="card-description text-justify">
                                            A window type aircon, also known as a window air conditioner, is a self-contained unit that is installed in a window or through a wall to cool a single room.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="card card-plain card-blog">
                                    <div class="card-image">
                                        <img class="img img-raised rounded" src="{{ asset('assets/img/suspended.png') }}" />
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            Suspended
                                        </h5>
                                        <p class="card-description text-justify">
                                            A suspended type AC, also known as a floor-mounted air conditioner, is a type of air conditioning unit that is designed to be mounted on the floor or suspended from the ceiling.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-5">
                                <div class="card card-plain card-blog">
                                    <div class="card-image">
                                        <img class="img img-raised rounded" src="{{ asset('assets/img/split.png') }}" />
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            Split
                                        </h5>
                                        <p class="card-description text-justify">
                                            A split type AC, also known as a split system air conditioner, is a type of air conditioning unit that consists of two main parts: an outdoor compressor unit and an indoor unit.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="card card-plain card-blog">
                                    <div class="card-image">
                                        <img class="img img-raised rounded" src="{{ asset('assets/img/concealed.png') }}" />
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            Concealed
                                        </h5>
                                        <p class="card-description text-justify">
                                            A concealed type AC, also known as a ducted air conditioning system, is a type of air conditioning unit that is designed to be installed in a concealed location, such as a ceiling void or crawl space.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-5">
                                <div class="card card-plain card-blog">
                                    <div class="card-image">
                                        <img class="img img-raised rounded" src="{{ asset('assets/img/tower.png') }}" />
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            Tower
                                        </h5>
                                        <p class="card-description text-justify">
                                            A tower type AC, also known as a tower air conditioner, is a type of air conditioning unit that is designed to be vertically oriented and takes up less floor space compared to traditional AC units.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="card card-plain card-blog">
                                    <div class="card-image">
                                        <img class="img img-raised rounded" src="{{ asset('assets/img/ushaped-window.png') }}" />
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            U-shaped window
                                        </h5>
                                        <p class="card-description text-justify">
                                            A U-shaped window type AC is a type of air conditioning unit that is designed to be installed in a window.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-5">
                                <div class="card card-plain card-blog">
                                    <div class="card-image">
                                        <img class="img img-raised rounded" src="{{ asset('assets/img/cassette.png') }}" />
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            Cassette
                                        </h5>
                                        <p class="card-description text-justify">
                                            A cassette type AC, also known as a ceiling cassette air conditioner, is a type of air conditioning unit that is designed to be installed in a suspended ceiling.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 ml-auto mr-auto">
                        <h2 class="title">Horsepower</h2>
                        <br />
                        <table class="table table-bordered table-striped bg-light">
                            <thead>
                                <tr>
                                    <th class="col-2">Room Size (sq. m.)</th>
                                    <th class="col-2">Aircon HP</th>
                                    <th class="col-8">Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>< 11</td>
                                    <td>0.5</td>
                                    <td>Appropriate for small rooms such as bedrooms, small offices, or guest rooms. 150-250 square feet.</td>
                                </tr>
                                <tr>
                                    <td>12 to 17</td>
                                    <td>0.75</td>
                                    <td>Appropriate for small to medium-sized rooms such as small bedrooms, home offices, or guest rooms. 200-300 square feet.</td>
                                </tr>
                                <tr>
                                    <td>18 to 22</td>
                                    <td>1.0</td>
                                    <td>Appropriate for medium-sized rooms such as living rooms, small apartments, or home studios. 400 to 600 square feet.</td>
                                </tr>
                                <tr>
                                    <td>23 to 27</td>
                                    <td>1.5</td>
                                    <td>Appropriate for larger rooms such as master bedrooms, large living areas, or dining rooms. 600 to 900 square feet.</td>
                                </tr>
                                <tr>
                                    <td>28 to 40</td>
                                    <td>2.0</td>
                                    <td>Appropriate for larger rooms such as family rooms or open-concept living spaces. 800 to 1,200 square feet.</td>
                                </tr>
                                <tr>
                                    <td>41 to 54</td>
                                    <td>2.5</td>
                                    <td>Suitable for larger rooms, such as open-plan living areas, commercial spaces, or office buildings. 1,000-1,500 square feet.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="container text-justify">
                <div class="row">
                    <div class="col-md-12 ml-auto mr-auto">
                        <h3 class="title">Initial/Current AC Condition</h3>
                        <p>To ensure the safety and reputation of our company, we require information on the initial/current condition of your air conditioning unit before we begin our services. This allows us to take necessary precautions and provide appropriate measures to address any issues or concerns related to your AC unit.</p>
                        <p>
                            <ol>
                                <li class="mb-3"><b>Cooling:</b> If the air conditioning unit is functioning properly and providing cool air as expected. If the unit is not cooling properly, it may indicate a problem with the refrigerant levels, air filter, or other components that need to be inspected and repaired.</li>
                                <li class="mb-3"><b>Mechanical Noise:</b> If there are any unusual sounds coming from the air conditioning unit during operation. Normal sounds include a low humming or whirring noise, but any loud or persistent rattling, banging, or squeaking sounds may indicate a problem with the unit's internal components.</li>
                                <li class="mb-3"><b>Electric/power Connectivity:</b> If the air conditioning unit is properly connected to a power source. It is important to ensure that the unit is properly connected to avoid any electrical hazards or damage to the unit. Additionally, if the unit is not receiving power, it will not be able to function properly.</li>
                            </ol>
                        </p>
                        <p>By providing us with this information, we can ensure the quality of our services and protect the integrity of our company.</p>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="container text-justify">
                <div class="row">
                    <div class="col-md-12 ml-auto mr-auto">
                        <h3 class="title">Minor Issues & Problems</h3>
                        <p>Air conditioning systems can also experience minor issues that can affect their performance and efficiency. Here are some common ones:</p>
                        <p>
                            <ol>
                                <li class="mb-3"><b>Clogged air filters:</b> Clogged air filters can reduce the airflow and efficiency of the air conditioning system, leading to poor cooling and increased energy consumption.</li>
                                <li class="mb-3"><b>Thermostat settings:</b> Incorrect thermostat settings or a malfunctioning thermostat can cause the air conditioning system to run inefficiently and waste energy.</li>
                                <li class="mb-3"><b>Dirty condenser coils:</b> Dirty condenser coils can reduce the efficiency of the air conditioning system and increase energy consumption.</li>
                                <li class="mb-3"><b>Loose electrical connections:</b> Loose electrical connections can cause the air conditioning system to malfunction or stop working altogether.</li>
                                <li class="mb-3"><b>Noisy operation:</b> Noisy operation can be caused by loose parts, worn-out fan belts, or a malfunctioning compressor.</li>
                                <li><b>Foul odors:</b> Foul odors can be caused by dirty air filters, mold growth, or other issues with the air conditioning system.</li>
                            </ol>
                        </p>
                        <p>While these issues may seem minor, they can still affect the performance and efficiency of the air conditioning system. It's important to address them promptly to prevent further damage or larger issues from occurring. Regular maintenance and inspections by a professional can help identify and address minor issues before they become major problems.</p>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="container text-justify">
                <div class="row">
                    <div class="col-md-12 ml-auto mr-auto">
                        <h3 class="title">Major Issues & Problems</h3>
                        <p>Air conditioning systems can have several major issues that can affect their performance and efficiency. Here are some common ones:</p>
                        <p>
                            <ol>
                                <li class="mb-3"><b>Poor airflow:</b> Poor airflow can be caused by dirty air filters, blocked ductwork, or a malfunctioning fan, and can result in poor cooling and reduced efficiency of the air conditioning system.</li>
                                <li class="mb-3"><b>Low refrigerant levels::</b> Low refrigerant levels can result in poor cooling and reduced efficiency of the air conditioning system. This can be caused by leaks in the refrigerant lines or a malfunctioning compressor.
                                </li>
                                <li class="mb-3"><b>Faulty thermostats:</b> Faulty thermostats can cause the air conditioning system to turn on and off frequently or not at all, leading to poor performance and energy wastage.</li>
                                <li class="mb-3"><b>Electrical problems:</b> Electrical problems such as faulty wiring or malfunctioning capacitors can cause the air conditioning system to malfunction or stop working altogether.</li>
                                <li class="mb-3"><b>Frozen evaporator coils:</b> Frozen evaporator coils can prevent the air conditioning system from cooling properly and can also cause the compressor to fail.</li>
                                <li class="mb-3"><b>Leaks in the ductwork:</b> Leaks in the ductwork can cause the air conditioning system to lose cool air, leading to poor cooling and increased energy consumption.</li>
                                <li><b>Blocked condenser:</b> A blocked condenser can reduce the efficiency of the air conditioning system, making it work harder and consume more energy.</li>
                            </ol>
                        </p>
                        <p>It's important to have your air conditioning system regularly maintained by a professional to prevent these and other issues from occurring.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="footer" data-background-color="blue">
    <div class="container">
        <ul class="pull-left">
            <li>
                <a href="/terms-conditions">
                    Terms & Conditions
                </a>
            </li>
            <li>
                <a href="/privacy-policy">
                    Privacy Policy
                </a>
            </li>
        </ul>
        <div class="copyright" id="copyright">
            &copy;
            <script>
                document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
            </script> Kooldoc All Rights Reserved.
        </div>
    </div>
</footer>

@endsection
