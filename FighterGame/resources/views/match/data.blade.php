<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="bg-success p-2 text-dark-bald bg-opacity-75">
            <h1>{{$match->character[0]->name}}</h1>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        Defence: {{ $match->character[0]->defence }}
                    </div>
                    <div class="col-md-6">
                        Strength: {{ $match->character[0]->strength }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        Accuracy: {{ $match->character[0]->accuracy }}
                    </div>
                    <div class="col-md-6">
                        Magic: {{ $match->character[0]->magic }}
                    </div>
                </div>
            </div>
            <h2>Hp: {{ $match->character[0]->pivot->hero_hp }}</h2>
        </div>
    </div>
    <div class="col-md-6">
        <div class="bg-danger p-2 text-dark bg-opacity-75">
            <h1>{{$match->character[1]->name}}</h1>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        Defence: {{ $match->character[1]->defence }}
                    </div>
                    <div class="col-md-6">
                        Strength: {{ $match->character[1]->strength }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        Accuracy: {{ $match->character[1]->accuracy }}
                    </div>
                    <div class="col-md-6">
                        Magic: {{ $match->character[1]->magic }}
                    </div>
                </div>
            </div>
            <h2>Hp: {{ $match->character[1]->pivot->hero_hp }}</h2>
        </div>
    </div>
</div>

