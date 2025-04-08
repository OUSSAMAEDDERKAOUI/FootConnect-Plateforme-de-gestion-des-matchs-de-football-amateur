window.renderSimplePagination = (paginationData,loadMatches ) => {
    const table = document.querySelector('table');
    let paginationContainer = document.getElementById('simple-pagination');
    
    if (!paginationContainer) {
        paginationContainer = document.createElement('div');
        paginationContainer.id = 'simple-pagination';
        paginationContainer.className = 'flex justify-center items-center space-x-2 my-4';
        table.parentNode.appendChild(paginationContainer);
    } else {
        paginationContainer.innerHTML = '';
    }
    
    const currentPage = paginationData.current_page;
    const totalPages = paginationData.last_page;
    
    // Previous button
    const prevButton = document.createElement('button');
    prevButton.className = `px-3 py-1 rounded border ${currentPage === 1 ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-white text-indigo-600 hover:bg-indigo-50'}`;
    prevButton.innerHTML = 'Prev';
    prevButton.disabled = currentPage === 1;
    if (currentPage !== 1) {
        prevButton.addEventListener('click', () => loadMatches(currentPage - 1));
    }
    paginationContainer.appendChild(prevButton);
    
    // Page numbers (show up to 5 pages)
    const maxVisiblePages = 5;
    let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
    let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);
    
    if (endPage - startPage + 1 < maxVisiblePages) {
        startPage = Math.max(1, endPage - maxVisiblePages + 1);
    }
    
    for (let i = startPage; i <= endPage; i++) {
        const pageButton = document.createElement('button');
        pageButton.className = `px-3 py-1 rounded border ${i === currentPage ? 'bg-indigo-600 text-white' : 'bg-white text-indigo-600 hover:bg-indigo-50'}`;
        pageButton.innerHTML = i;
        pageButton.addEventListener('click', () => loadMatches(i));
        paginationContainer.appendChild(pageButton);
    }
    
    // Next button
    const nextButton = document.createElement('button');
    nextButton.className = `px-3 py-1 rounded border ${currentPage === totalPages ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-white text-indigo-600 hover:bg-indigo-50'}`;
    nextButton.innerHTML = 'Next';
    nextButton.disabled = currentPage === totalPages;
    if (currentPage !== totalPages) {
        nextButton.addEventListener('click', () => loadMatches(currentPage + 1));
    }
    paginationContainer.appendChild(nextButton);
    
    // Add pagination info
    const infoText = document.createElement('div');
    infoText.className = 'text-sm text-gray-500 ml-4';
    infoText.innerHTML = `Page ${currentPage} of ${totalPages}`;
    paginationContainer.appendChild(infoText);
}