const API_INGREDIENT = 'https://www.thecocktaildb.com/api/json/v1/1/search.php?i=';

const INGREDIENT_OVERVIEW_LIST = document.getElementById('ingredients');
const INGREDIENT_FIELD_LIST = document.getElementById("ingredientsAndMeasurements-fields-list");
const INGREDIENT_BTN = document.getElementById('add-another-ingredient');
const INGREDIENT_STORE_BTN = document.getElementById('confirm-ingredient');
const INGREDIENT_SUGGESTION = document.getElementById('ingredient_suggestion_option');

async function fetchFromAPI(input) {
    let json = await fetch(API_INGREDIENT + input.toString());
    let source = await json.json();
    
    return source['ingredients'][0].strIngredient;
}

async function showIngredientSuggestion (domElement){

    let input = domElement.target.value

    if (input === "") {return}

    let output = await fetchFromAPI(input).catch(() => {
        console.log('No such ingredient in stock')
    });

    INGREDIENT_SUGGESTION.innerHTML = output
    INGREDIENT_SUGGESTION.value = output
}

document.getElementById('add-another-ingredient').addEventListener('click',()=>{

    INGREDIENT_BTN.style.display = 'none'
    INGREDIENT_STORE_BTN.style.display = 'block'

    let list = INGREDIENT_FIELD_LIST;
    let counter = list.getElementsByTagName("li").length
    let newWidget = list.getAttribute('data-prototype')

    newWidget = newWidget.replace(/__name__/g, counter.toString() )

    let newElem = document.createElement(list.getAttribute('data-widget-tags'))
    newElem.innerHTML = newWidget
    list.append(newElem)

    document.getElementById(`home_brew_ingredientsAndMeasurements_${counter}_ingredient`).addEventListener('keyup',showIngredientSuggestion)

    list.setAttribute('widget-counter',counter.toString());

});

document.getElementById('confirm-ingredient').addEventListener("click",()=>{

    INGREDIENT_BTN.style.display = 'block'
    INGREDIENT_STORE_BTN.style.display = 'none'
    INGREDIENT_FIELD_LIST.lastElementChild.style.display = 'none'

    let counter = INGREDIENT_FIELD_LIST.getElementsByTagName("li").length-1
    let measure = document.getElementById(`home_brew_ingredientsAndMeasurements_${counter}_measurement`).value
    let metric = document.getElementById(`home_brew_ingredientsAndMeasurements_${counter}_metric`).value
    let ingredient = document.getElementById(`home_brew_ingredientsAndMeasurements_${counter}_ingredient`).value

    INGREDIENT_OVERVIEW_LIST.innerHTML += `<li>${measure} ${metric} ${ingredient}</li>`
})
