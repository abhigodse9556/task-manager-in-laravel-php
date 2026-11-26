const applyFilterBtn = document.getElementById("apply-filter-btn");
const taskFilterBlock = document.getElementById("tasks-filter-block");

if(applyFilterBtn) {
    applyFilterBtn.addEventListener('click', ()=>{
        taskFilterBlock.classList.toggle('open');
        if(taskFilterBlock.classList.contains('open')){
            applyFilterBtn.textContent = 'Close filters';
        } else {
            applyFilterBtn.textContent = 'Apply filters';
        }
    });
}