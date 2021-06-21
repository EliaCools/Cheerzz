const API_INGREDIENT = 'https://www.thecocktaildb.com/api/json/v1/1/search.php?i=';
const INPUT = document.getElementById('find_Ingredient');

async function fetchIngredient(input) {

    let json = await fetch(API_INGREDIENT + input.toString());
    let source = await json.json();
    return source['ingredients'][0].strIngredient;
}

async function logIngredient() {

    if (INPUT.value === "") {
        console.log('No Ingredient was entered')
        return
    }

    let ingredient = await fetchIngredient(INPUT.value).catch(() => {
        console.log('Ingredient was not found')
    })
    console.log(ingredient);
}

// document.getElementById('find_Ingredient').addEventListener('keyup', async () => {
//
//     if (INPUT.value === "") {
//         return
//     }
//
//     let input = await fetchIngredient(INPUT.value).catch(() => {
//         console.log('No such ingredient in stock')
//     });
//     console.log(input);
// })


let example = [{0: 'cola', 1: 'test'}, {0: 'rum', 1: '10 ml'}];

let i = 0;

document.getElementById('add-another-ingredient').addEventListener('click',()=>{

    let list = document.getElementById("ingredientsAndMeasurements-fields-list");
    let counter = list.getElementsByTagName("li").length
    let newWidget = list.getAttribute('data-prototype')

    // replace the "__name__" used in the id and name of the prototype
    // with a number that's unique to your emails
    // end name attribute looks like name="contact[emails][2]"
    newWidget = newWidget.replace(/__name__/g, counter.toString() )

    // Increase the counter
    counter++;
    // And store it, the length cannot be used if deleting widgets is allowed
    list.setAttribute('widget-counter',counter.toString());
    console.log((list.getAttribute('data-widget-tags')))
    // create a new list element and add it to the list
    let newElem = document.createElement(list.getAttribute('data-widget-tags'))
    newElem.innerHTML = newWidget
    list.append(newElem)

})



