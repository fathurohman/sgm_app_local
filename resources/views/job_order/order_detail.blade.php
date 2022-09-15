<div class="table-responsive">
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <th>Party</th>
            <th>HBL</th>
            <th>MBL</th>
            <th>Vessel 1</th>
            <th>Vessel 2</th>
            <th>Consignee</th>
            <th>Agent Overseas</th>
            <th>ETD</th>
            <th>ETA</th>
        </thead>
        <tbody>
            <tr>
                <td>{{ $job_detail->party }}</td>
                <td>{{ $job_detail->HBL }}</td>
                <td>{{ $job_detail->MBL }}</td>
                <td>{{ $job_detail->vessel1 }}</td>
                <td>{{ $job_detail->vessel2 }}</td>
                <td>{{ $job_detail->consignee }}</td>
                <td>{{ $job_detail->agent_overseas }}</td>
                <td>{{$job_detail->ETD}}</td>
                <td>{{$job_detail->ETA}}</td>
            </tr>
        </tbody>
    </table>
</div>
