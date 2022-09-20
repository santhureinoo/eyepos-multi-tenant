<main>
    <div class="container">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form method="POST" action="{{ route('satisfaction.create') }}">
                            @csrf
                            @method('put')
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label class="form-label" for="date">Date of Visit</label>
                                    <input value="{{ $visit->created_at }}" name="date" id="date" type="text" class="form-control @error('date') is-invalid @else is-valid @enderror" readonly>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label" for="purpose">Purpose of Visit</label>
                                    <input value="{{ $visit->purpose }}" name="purpose" id="purpose" type="text" class="form-control @error('purpose') is-invalid @else is-valid @enderror" readonly>
                                </div>
                            </div>
                            @include('questionnaire.satisfaction.procedure')
                            @include('questionnaire.satisfaction.satisfaction')
                            @include('questionnaire.satisfaction.recommend')

                            <br>
                            <label class="form-label" for="other">What do you like most about your visit today?</label>
                            <input name="visit" id="visit" type="text" class="form-control @error('visit') is-invalid @else is-valid @enderror">

                            <label class="form-label" for="improvement">What suggestions for improvement do you have for your visit?</label>
                            <input name="improvement" id="improvement" type="text" class="form-control @error('improvement') is-invalid @else is-valid @enderror">

                            <br>
                            <button class="btn btn-primary">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
