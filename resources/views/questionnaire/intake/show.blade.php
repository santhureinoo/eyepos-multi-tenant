<main>
    <div class="container">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form method="POST" action="{{ route('intake.create') }}">
                            @csrf
                            @method('put')
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label class="form-label" for="first_name">First name</label>
                                    <input name="first_name" id="first_name" type="text" class="form-control @error('first_name') is-invalid @else is-valid @enderror">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label" for="last_name">Surname</label>
                                    <input name="last_name" id="last_name" type="text" class="form-control @error('last_name') is-invalid @else is-valid @enderror">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label class="form-label" for="email">Email address</label>
                                    <input name="email" id="email" type="email" class="form-control @error('email') is-invalid @else is-valid @enderror">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label" for="phone">Phone</label>
                                    <input name="phone" id="phone" type="text" class="form-control @error('phone') is-invalid @else is-valid @enderror">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label" for="age">Age</label>
                                    <input name="age" id="age" type="text" class="form-control @error('age') is-invalid @else is-valid @enderror">
                                </div>
                            </div>

                            @include('questionnaire.intake.wearing')
                            @include('questionnaire.intake.history')
                            @include('questionnaire.intake.conditions')
                            @include('questionnaire.intake.change')

                            <br>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="issues_near" id="issues_near">
                                <label class="form-check-label" for="issues_mobile">
                                    Do you have difficulties reading your mobile phone or small words with your current glasses or contact lenses?
                                </label>
                            </div>

                            <br>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="issues_far" value="issues_far" id="issues_far">
                                <label class="form-check-label" for="issues_far">
                                    Do you have difficulties seeing far (e.g. looking at road signs/ bus number/ recognising faces) with your current glasses or contact lenses?
                                </label>
                            </div>

                            <br>
                            <label class="form-label" for="other">Other</label>
                            <input name="other" id="other" type="text" class="form-control @error('other') is-invalid @else is-valid @enderror">

                            <!-- TODO: Make data mandatory -->
                            @include('questionnaire.intake.consent')

                            <br>
                            <button class="btn btn-primary">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
