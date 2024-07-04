@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron text-center mt-4">
            <h1 class="display-4">Dobrodošli na Auto Forum</h1>
            <p class="lead">Vaša platforma za sve stvari u automobilskoj industriji. Osnovana 2023. godine, naša misija je da pomognemo ljubiteljima automobila i novim vozačima.</p>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h2>O Auto Forumu</h2>
                <p>Auto Forum je nastao 2023. godine sa svrhom povezivanja auto-entuzijasta, pružanja vrijednih informacija i njegovanja zajednice istomišljenika. Bilo da ste iskusan stručnjak za automobile ili novi vozač, naš forum nudi bogato znanje i podršku.</p>
                <h3>Naša svrha</h3>
                <ul>
                    <li>Pružiti platformu za diskusiju o automobilskim temama</li>
                    <li>Da ponudimo smjernice i savjete za nove vozače</li>
                    <li>Da podijelimo najnovije vijesti i trendove u automobilskom svijetu</li>
                    <li>Stvoriti zajednicu podrške za entuzijaste automobila</li>
                </ul>
                <h3>Kako možemo pomoći</h3>
                <p>Novi korisnici mogu pronaći odgovore na svoja pitanja vezana za automobile, dobiti preporuke o modelima automobila, naučiti o održavanju automobila i povezati se s drugim vlasnicima automobila. Naši forumi pokrivaju širok raspon tema od tehničkih savjeta do recenzija automobila i još mnogo toga.</p>
            </div>

            <div class="col-md-6">
                <h2>Kontaktiraj nas</h2>
                <p>Ako imate bilo kakvih pitanja, slobodno nam se obratite koristeći kontakt informacije ispod ili popunjavanjem kontakt forme.</p>
                <ul class="list-unstyled">
                    <li><strong>Email:</strong> contact@autoforum.com</li>
                    <li><strong>Telefon:</strong> +381600906914</li>
                    <li><strong>Lokacija:</strong>Dimitrija Tucovica bb</li>
                </ul>

                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Ime</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Poruka</label>
                        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                    </div>
                    <button style="margin-top:20px;" type="submit" class="btn btn-primary">Posalji poruku</button>
                </form>
            </div>
        </div>
    </div>
@endsection
