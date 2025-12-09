// Dashboard JavaScript functionality

// Handle Add Experiment Form
document.getElementById('addExperimentForm')?.addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const experimentNo = document.getElementById('experiment_no').value;
    const experimentName = document.getElementById('experiment_name').value;
    const experimentCode = document.getElementById('experiment_code').value;
    
    if (!experimentNo || !experimentName || !experimentCode) {
        alert('Please fill all fields');
        return;
    }
    
    try {
        const formData = new FormData();
        formData.append('experiment_no', experimentNo);
        formData.append('experiment_name', experimentName);
        formData.append('code', experimentCode);
        
        const response = await fetch('add_experiment.php', {
            method: 'POST',
            body: formData
        });
        
        const result = await response.json();
        
        if (result.success) {
            alert('Experiment added successfully!');
            location.reload();
        } else {
            alert('Error: ' + result.message);
        }
    } catch (error) {
        console.error('Error:', error);
        alert('An error occurred while adding the experiment');
    }
});

// Handle Delete Experiment
async function deleteExperiment(id, experimentNo) {
    if (!confirm(`Are you sure you want to delete Experiment #${experimentNo}?`)) {
        return;
    }
    
    try {
        const formData = new FormData();
        formData.append('id', id);
        formData.append('experiment_no', experimentNo);
        
        const response = await fetch('delete_experiment.php', {
            method: 'POST',
            body: formData
        });
        
        const result = await response.json();
        
        if (result.success) {
            alert('Experiment deleted successfully!');
            location.reload();
        } else {
            alert('Error: ' + result.message);
        }
    } catch (error) {
        console.error('Error:', error);
        alert('An error occurred while deleting the experiment');
    }
}

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Auto-hide alerts after 5 seconds
setTimeout(function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        const fadeEffect = setInterval(function() {
            if (!alert.style.opacity) {
                alert.style.opacity = 1;
            }
            if (alert.style.opacity > 0) {
                alert.style.opacity -= 0.1;
            } else {
                clearInterval(fadeEffect);
                alert.style.display = 'none';
            }
        }, 50);
    });
}, 5000);

