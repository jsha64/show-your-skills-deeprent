{{-- <div>
    data table blade
</div> --}}


@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Unit Data Table</h1>

    <!-- Search Input -->
    <input type="text" id="search" class="form-control mb-3" placeholder="Search by unit name...">

    <!-- Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Unit Name</th>
                <th>Size</th>
            </tr>
        </thead>
        <tbody id="unitTableBody">
            <!-- Data will be populated here -->
        </tbody>
    </table>

    <!-- Pagination Controls -->
    <div class="d-flex justify-content-between">
        <button id="prevPage" class="btn btn-secondary">Previous</button>
        <span id="pageInfo"></span>
        <button id="nextPage" class="btn btn-secondary">Next</button>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    let unitData = [];
    let filteredData = [];
    let currentPage = 1;
    const unitsPerPage = 3;

    // Fetch data from JSON file
    fetch('/example/unit-data.json')
        .then(response => response.json())
        .then(data => {
            // Sort by size (smallest to largest)
            unitData = data.sort((a, b) => a.size - b.size);
            filteredData = unitData;
            renderTable();
        });

    // Render table function
    function renderTable() {
        const tableBody = document.getElementById("unitTableBody");
        tableBody.innerHTML = "";

        const start = (currentPage - 1) * unitsPerPage;
        const end = start + unitsPerPage;
        const paginatedData = filteredData.slice(start, end);

        paginatedData.forEach(unit => {
            const row = `<tr>
                            <td>${unit.name}</td>
                            <td>${unit.size}</td>
                        </tr>`;
            tableBody.innerHTML += row;
        });

        updatePagination();
    }

    // Search functionality
    document.getElementById("search").addEventListener("input", function () {
        const searchTerm = this.value.toLowerCase();
        filteredData = unitData.filter(unit => unit.name.toLowerCase().includes(searchTerm));
        currentPage = 1;
        renderTable();
    });

    // Pagination controls
    document.getElementById("prevPage").addEventListener("click", function () {
        if (currentPage > 1) {
            currentPage--;
            renderTable();
        }
    });

    document.getElementById("nextPage").addEventListener("click", function () {
        if (currentPage * unitsPerPage < filteredData.length) {
            currentPage++;
            renderTable();
        }
    });

    function updatePagination() {
        document.getElementById("pageInfo").textContent = `Page ${currentPage} of ${Math.ceil(filteredData.length / unitsPerPage)}`;
        document.getElementById("prevPage").disabled = currentPage === 1;
        document.getElementById("nextPage").disabled = currentPage * unitsPerPage >= filteredData.length;
    }
});
</script>
@endsection
