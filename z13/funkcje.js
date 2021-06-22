const ksiazkiElem = document.getElementById('ksiazki');
ksiazkiElem.style.display = 'none'
const opisy =[]

/**
 * Podłączenie zdarzenia click do przycisku pobierz
 */
document.getElementById('btnPokaz').addEventListener('click', async () => {
    const resp = await fetch('ksiazki.xml')
    const text = await resp.text()

    const parser = new DOMParser()
    const xml = parser.parseFromString(text, 'text/xml')

    xml.querySelectorAll('ksiazka').forEach((k) => pokazKsiazke(k))
    ksiazkiElem.style.display = 'block'
})

/**
 * Podłączenie zdarzenia click dla przycisku pokaż opis
 */
document.body.addEventListener('click', (e) => {
    if (e.target.matches('[data-id]')) {
        const id = e.target.dataset.id

        pokazOpis(id);
    }
})
/*
* Funkcja ukrywająca przycisk po wciśnięciu go
*/
function hideButton(){
    document.getElementById("btnPokaz").style.display="none";
}

/**
 * Wyświetla dane pojedynczej książki w tabeli HTML.
 */
function pokazKsiazke(ksiazka) {
    const id = wartosc(ksiazka, 'id')
    const col = wybierzKolor(wartosc(ksiazka, 'kategoria'))
    opisy[id] = wartosc(ksiazka, 'opis')
    const wiersz = `
        <tr ${col}>
            <td>${id}</td>
            <td>${wartosc(ksiazka, 'tytul')}</td>
            <td>${wartosc(ksiazka, 'autor')}</td>
            <td>${wartosc(ksiazka, 'kategoria')}</td>
            <td>${wartosc(ksiazka, 'cena')}</td>
            <td>${wartosc(ksiazka, 'liczba_stron')}</td>
            <td>${wartosc(ksiazka, 'isbn')}</td>
            <td><button class="btn btn-link" data-id="${id}">pokaż opis</button>
        </tr>
    `
    const template = document.createElement('template')
    template.innerHTML = wiersz.trim()
    ksiazkiElem.querySelector('tbody').appendChild(template.content.firstChild)
}
/*
* Wybierz kolor wiersza w zależności od kategorii
*/
function wybierzKolor(kat){
    if(kat == "kryminał i sensacja"){
        return 'class="table-primary"';
    }
    else if(kat == "fantastyka"){
        return 'class="table-success"';
    }
    else if(kat == "podróże"){
        return 'class="table-warning"';
    }
    else{
        return 'class="table-info"';
    }
}

/**
 * Zwraca wartość zagnieżdzonego elementu XML.
 *
 * @param {HTMLElement} element
 * @param {string} pole
 * @returns
 */
function wartosc(element, pole) {
    return element.querySelector(pole).textContent
}

/**
 * Pokazuje alert z informacją o opisie książki.
 *
 * @param {number} id
 */
function pokazOpis(id) {
    document.getElementById("opis").innerHTML=opisy[id];    
}
