  function loadData() {
    let country = getCountry().toLowerCase();
    fetch('http://localhost/savjetovanja/api/consultations/'+country+'/read.php')
    .then(response => response.json())
    .then(data => populateDOM(data));
  }
  

  function populateDOM(data) {   
    if(document.querySelectorAll(".toBeDeleted")) {
      document.querySelectorAll(".toBeDeleted").forEach(element => {
        element.remove();
      });
    }   
      let items = data.data;
      items.forEach(item => {
        createListItem(item);
      });      
  }


  function setCountry(country) {
    let currentCountry = country;
    console.log(currentCountry);
    localStorage.setItem('currentCountry', currentCountry);
    document.querySelector('#countryDisplay').innerHTML = country;
    document.querySelector('#countrySelectButton').innerHTML = country;
    loadData();
  }

  function getCountry() {
    if(localStorage.getItem('currentCountry')) {
      return localStorage.getItem('currentCountry');
    } else {
      document.querySelector('#countrySelector').setAttribute('aria-hidden', false);
    }
  }


function createListItem(item) {

        const list = document.querySelector('#list-items');

        let row = document.createElement('tr');
        let cityTD = document.createElement('td');
        let institutionTD = document.createElement('td');
        let addressTD = document.createElement('td');
        let dateTD = document.createElement('td');
        let timespanTD = document.createElement('td');
        let phoneTD = document.createElement('td');
        let editTD = document.createElement('td');
        let editIcon = document.createElement('i');
        let delIcon = document.createElement('i');
        let editBTN = document.createElement('button');
        let delBTN = document.createElement('button');

        row.classList.add("toBeDeleted");

        editIcon.classList.add("fas");
        editIcon.classList.add("fa-pen");
        delIcon.classList.add("fas");
        delIcon.classList.add("fa-trash");

        editBTN.classList.add("btn");
        editBTN.classList.add("btn-info");
        delBTN.classList.add("btn");
        delBTN.classList.add("btn-danger");

        editBTN.setAttribute("data-toggle", "modal");
        delBTN.setAttribute("data-toggle", "modal");

        editBTN.setAttribute("data-target", "#exampleModalCenter");
        delBTN.setAttribute("data-target", "#exampleModalCenterDelete");

        editBTN.setAttribute("data-id", item.id);
        delBTN.setAttribute("data-id", item.id);

        editBTN.appendChild(editIcon);
        delBTN.appendChild(delIcon);

        editTD.appendChild(editBTN);
        editTD.appendChild(delBTN);

        cityTD.innerHTML = item.city;
        institutionTD.innerHTML = item.institution;
        addressTD.innerHTML = item.address;
        dateTD.innerHTML = item.date;
        timespanTD.innerHTML = item.timespan;
        phoneTD.innerHTML = item.phone;

        row.appendChild(cityTD);
        row.appendChild(institutionTD);
        row.appendChild(addressTD);
        row.appendChild(dateTD);
        row.appendChild(timespanTD);
        row.appendChild(phoneTD);
        row.appendChild(editTD);
    
        list.appendChild(row);

}