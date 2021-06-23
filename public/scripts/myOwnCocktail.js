const API_INGREDIENT = 'https://www.thecocktaildb.com/api/json/v1/1/search.php?i=';

const INGREDIENT_FIELD_LIST = document.getElementById("ingredientsAndMeasurements-fields-list");
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

    let list = INGREDIENT_FIELD_LIST;
    let counter = list.getElementsByTagName("li").length
    let newWidget = list.getAttribute('data-prototype')

    newWidget = newWidget.replace(/__name__/g, counter.toString() )

    let newElem = document.createElement(list.getAttribute('data-widget-tags'))
    newElem.innerHTML = newWidget
    newElem.classList.add('pb-3')
    list.append(newElem)

    document.getElementById(`home_brew_ingredientsAndMeasurements_${counter}_ingredient`).addEventListener('keyup',showIngredientSuggestion)

    counter++
    list.setAttribute('widget-counter',counter.toString());

});

