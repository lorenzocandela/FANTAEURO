const owner = window.location.pathname.split('/').pop().replace('.php', '');

document.getElementById('owner').value = owner;

const formations = {
    "3-5-2": ["POR", "DIF", "DIF", "DIF", "CEN", "CEN", "CEN", "CEN", "CEN", "ATT", "ATT"],
    "3-4-3": ["POR", "DIF", "DIF", "DIF", "CEN", "CEN", "CEN", "CEN", "ATT", "ATT", "ATT"],
    "4-4-2": ["POR", "DIF", "DIF", "DIF", "DIF", "CEN", "CEN", "CEN", "CEN", "ATT", "ATT"],
    "4-3-3": ["POR", "DIF", "DIF", "DIF", "DIF", "CEN", "CEN", "CEN", "ATT", "ATT", "ATT"],
    "4-5-1": ["POR", "DIF", "DIF", "DIF", "DIF", "CEN", "CEN", "CEN", "CEN", "CEN", "ATT"],
    "5-4-1": ["POR", "DIF", "DIF", "DIF", "DIF", "DIF", "CEN", "CEN", "CEN", "CEN", "ATT"],
    "5-3-2": ["POR", "DIF", "DIF", "DIF", "DIF", "DIF", "CEN", "CEN", "CEN", "ATT", "ATT"]
};

let selectedPlayers = {};  // mem titolari
let selectedSubstitutes = {};  // mem panchinari

function updateFormation() {
    const formationSelect = document.getElementById('formationSelect');
    const formationDiv = document.getElementById('formation');
    const selectedFormation = formationSelect.value;

    // pulizia
    formationDiv.innerHTML = '';

    // set giocatori
    formations[selectedFormation].forEach((role, index) => {
        const playerDiv = document.createElement('div');
        playerDiv.className = 'player';
        playerDiv.textContent = role;
        playerDiv.dataset.role = role;
        playerDiv.dataset.index = index;
        playerDiv.onclick = () => selectPlayerRole(role, index);
        formationDiv.appendChild(playerDiv);
    });
}

function selectPlayerRole(role, index) {
    const owner = document.getElementById('owner').value;
    fetch('fetch_players.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `role=${role}&owner=${owner}`
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        displayPlayers(data, role, index);
        displaySubstitutes(data);
    })
    .catch(error => console.error('Errore:', error));
}


function displayPlayers(players, role, index) {
    const playersList = document.getElementById('playersList');
    playersList.innerHTML = ''; 

    players.forEach(player => {
        const playerDiv = document.createElement('div');
        playerDiv.className = 'player-card';
        playerDiv.textContent = `${player.name}`;
        playerDiv.onclick = () => selectPlayer(player, role, index);
        playersList.appendChild(playerDiv);
    });
}

function selectPlayer(player, role, index) {
    selectedPlayers[index] = {
        role: role,
        player_id: player.id,
        player_name: player.name 
    };

    const formationDiv = document.getElementById('formation');
    const playerDiv = formationDiv.querySelector(`.player[data-index='${index}']`);
    playerDiv.textContent = `${player.name}`;
}

function displaySubstitutes(players) {
    const substitutesList = document.getElementById('panchinariList');
    substitutesList.innerHTML = '';

    players.forEach(player => {
        const playerDiv = document.createElement('div');
        playerDiv.className = 'player-card';
        playerDiv.textContent = `${player.name}`;
        playerDiv.onclick = () => selectSubstitute(player);
        substitutesList.appendChild(playerDiv);
    });
}

function selectSubstitute(player) {
selectedSubstitutes[player.id] = {
    role: 'PANCHINA',
    player_id: player.id,
    player_name: player.name
};
}

function saveFormation() {
const owner = document.getElementById('owner').value;
const idGiornata = document.getElementById('id_giornata').value;
const formationArray = Object.values(selectedPlayers);
const substitutesArray = Object.values(selectedSubstitutes);

formationArray.forEach(player => {
    player.id_giornata = idGiornata;
});

substitutesArray.forEach(player => {
    player.id_giornata = idGiornata;
});

const allPlayers = [...formationArray, ...substitutesArray];

const dataToSend = JSON.stringify({
    owner: owner,
    formation: allPlayers
});

function displayTitolari(titolari) {
    const titolariList = document.getElementById('titolariList');
    titolariList.innerHTML = '';

    titolari.forEach(titolare => {
        const titolareDiv = document.createElement('div');
        titolareDiv.className = 'titolare';
        titolareDiv.textContent = `Ruolo: ${titolare.role}, Nome: ${titolare.player_name}`;
        titolariList.appendChild(titolareDiv);
    });
}


console.log("Data to send:", dataToSend); // per controlli

fetch('save_formation.php', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body: dataToSend
})
.then(response => {
    return response.json().then(data => ({ status: response.status, body: data }));
})
.then(({ status, body }) => {
    if (status >= 400) {
        throw new Error(`HTTP error! status: ${status}, message: ${body.error || 'Unknown error'}`);
    }
    console.log('Formazione salvata con successo:', body);
    displayTitolari(formationArray);

    window.location.href = `https://fantaeuropei.netsons.org/webapp/${owner}.php`;
})
.catch(error => console.error('Errore nel salvataggio della formazione:', error));
}