function confirmDelete(event, companyId) {
    event.preventDefault(); // Prevent the default link behavior

    if (confirm("Are you sure you want to delete this item?")) {
        // If confirmed, redirect to the URL with the company ID
        window.location.href = '/delete-company/' + companyId;
    }
}