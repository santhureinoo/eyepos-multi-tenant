<h1>Eye Examination Report</h1>

<h3>Name: {{ $examination->customer->first_name }} {{ $examination->customer->last_name }}</h3>
<h3>Type: {{ ucfirst($examination->category) }}</h3>
<h3>Date: {{ $examination->created_at }}</h3>
<table>
    <tbody>
        <tr>
            <td>Pupillary Reflex</td>
            <td>{{ $examination->pupillary_reflex }}</td>
        </tr>
        <tr>
            <td>Lid</td>
            <td>{{ $examination->eyelids }}</td>
        </tr>
        <tr>
            <td>Conjunctiva</td>
            <td>{{ $examination->conjunctiva }}</td>
        </tr>
        <tr>
            <td>Cornea</td>
            <td>{{ $examination->cornea }}</td>

        </tr>
        <tr>
            <td>Iris</td>
            <td>{{ $examination->iris }}</td>

        </tr>
        <tr>
            <td>Crystalline Lens</td>
            <td>{{ $examination->crystalline_lens }}</td>

        </tr>
        <tr>
            <td>Optic Disc</td>
            <td>{{ $examination->optic_nerve }}</td>
        </tr>
        <tr>
            <td>Macula</td>
            <td>{{ $examination->macula }}</td>
        </tr>
        <tr>
            <td>Posterior Pole</td>
            <td>{{ $examination->retina_posterior_pole }}</td>
        </tr>
    </tbody>
</table>
<h3>Recommendations:</h3>
@if($examination->rec_prescription)
    New Prescription Glasses
    <br>
@endif
@if($examination->rec_referral)
    Refer to ophthalmologist for further investigation
    <br>
@endif
@if($examination->rec_reexamination)
    Re-examination in months
    <br>
@endif
@if($examination->rec_myopia)
    Myopia management solutions e.g. spectacle lenses
    <br>
@endif
@if($examination->rec_supplements)
    Supplements e.g. preservative free eye drops/eye supplements
    <br>
@endif
<h3>Comments:</h3>
@if($examination->rec_other)
    {{ $examination->rec_other }}
    <br>
@endif
