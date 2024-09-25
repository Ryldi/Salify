const hamburger = document.querySelector(".toggle-btn");
const overlay = document.getElementById("overlay");

hamburger.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("expand");
  overlay.classList.toggle("show");

  const mainContent = document.getElementById('main-content');
  mainContent.classList.toggle('blurred-background');
});

overlay.addEventListener("click", function () {
  overlay.classList.remove("show");
  document.querySelector("#sidebar").classList.remove("expand");
});

// New Transaction Page - Start
let serviceCount = 1;

if(document.getElementById('addServiceBtn')) {
  document.getElementById('addServiceBtn').addEventListener('click', function() {
    serviceCount++;

    // Get the template and clone it
    let template = document.getElementById('service-template');
    let clone = document.importNode(template.content, true);

    // Update IDs and labels in the cloned template
    clone.querySelectorAll('[id]').forEach(el => {
        el.id = el.id.replace('{index}', serviceCount);
    });
    clone.querySelectorAll('label').forEach(el => {
        el.innerHTML = el.innerHTML.replace('{index}', serviceCount);
    });

    // Append the cloned template to the container
    let container = document.getElementById('serviceInputContainer');
    container.appendChild(clone);

    updateServiceLabels();
  });
}



  // Delegate delete button clicks
  if(document.getElementById('serviceInputContainer')) {
    document.getElementById('serviceInputContainer').addEventListener('click', e => {
        if (e.target && e.target.classList.contains('delete-service-btn')) {
            let rows = document.querySelectorAll('#serviceInputContainer .form-group');
            if (rows.length > 1) {  // Ensure at least one row remains
                e.target.closest('.form-group').remove();
                updateServiceLabels();
            }
        }
    });
  }

  function updateServiceLabels() {
      let rows = document.querySelectorAll('#serviceInputContainer .form-group');
      rows.forEach((row, index) => {
          let serviceNumber = index + 1;
          row.querySelector('label[for^="service-"]').setAttribute('for', `service-${serviceNumber}`);
          row.querySelector('label[for^="service-"]').textContent = `Service ${serviceNumber}`;
          row.querySelector('select[name="service[]"]').setAttribute('id', `service-${serviceNumber}`);
          row.querySelector('input[name="price[]"]').setAttribute('id', `price-${serviceNumber}`);
          row.querySelector('select[name="employee[]"]').setAttribute('id', `employee-${serviceNumber}`);
      });
      serviceCount = rows.length;

      // Enable or disable the add button based on the number of services
      let row = document.querySelector('#serviceInputContainer .form-group');
      let deleteBtn = row.querySelector('.delete-service-btn');

      if(serviceCount === 1) {
        deleteBtn.disabled = true;
      }else{
        deleteBtn.disabled = false;
      }
  }

// New Transaction Page - End