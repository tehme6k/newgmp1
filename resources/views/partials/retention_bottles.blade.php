@if($retentions->count() > 0)
    <table class="table">
        <thead>
        <th>Lot #</th>
        <th>Name</th>
        <th>Production</th>
        <th>Expiration</th>
        <th>Added By</th>
        </thead>

        <tbody>

        </tbody>
    </table>

@else
    <h3 class="text-center">No bottles at this time</h3>
@endif