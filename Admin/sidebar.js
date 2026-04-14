function showContent(id) {
    let sections = document.querySelectorAll('.content-section');
    sections.forEach(section => {
        section.style.display = 'none';
    });
    document.getElementById(id).style.display = 'block';
} 