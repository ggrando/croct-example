<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PlayGround</title>

  <script src="https://cdn.croct.io/js/v1/lib/plug.js?appId=00000000-0000-0000-0000-000000000000"></script>
  <script>
  croct.plug();
  croct.tracker.enable();
  </script>

</head>

<body>
<button onclick="askBirthDate()">Ask my birth date</button>
<button onclick="showAge()">Show my age</button>
<br><br>
<details onclick="addQuestion('pricing')">
    <summary>How much does Croct cost?</summary>
    <p>Try Croct free for 14 days, no credit card required.</p>
</details>

<details onclick="addQuestion('ease of use')">
    <summary>Do I need to be a developer to use Croct?</summary>
    <p>No, you don't need to be a developer to use Croct.</p>
</details>

<br/>

<button onclick="hasQuestion('pricing')">
  Do I have questions about pricing?
</button>

<button onclick="hasQuestion('ease of use')">
  Do I have questions about ease of use?
</button>

<br><br><br>

<button onclick="updateCart([{id: 'coffee', product: 'Coffee', price: 5}])">
  ☕ Buy a coffee
</button>

<br /><br />

<button onclick="showOffers()">Show offers</button>
<button onclick="updateCart([])">Clear cart</button>

<br> <br> 

<button onclick="like('1234')">
👍 Like
</button>

<br><br>

<button onclick="identify()">
Identify
</button>

<button onclick="getUserId()">
Get user ID
</button>

<button onclick="anonymize()">
Anonymize
</button>

<script>  
  croct.evaluate(`user is returning`)
    .then(returning => alert(returning ? 'Welcome back!' : 'Welcome!')); 
    croct.evaluate(`user's stats' sessions`)
    .then(count => alert(`Visits: ${count}`));

    
   function askBirthDate() { 
    const birthDate = prompt("What's your birth date?", "YYYY-MM-DD");

    croct.user.edit()
      .set('birthDate', birthDate)
      .save()
      .then(() => alert('Thank you!'));
  }
  function showAge() { 
    croct.evaluate(`user's age`)
      .then(alert);
 }

 function addQuestion(question) {
    croct.session.edit()
      .add('questions', question)
      .save();
  }
  
  function hasQuestion(question) {
    croct.evaluate(`session's questions include '${question}'`).then(alert);
  }
  function showOffers() {
    croct.evaluate("cart is not empty and no item in cart satisfies item's name matches 'Combo'")
      .then(eligible => {
        if (!eligible) {
          alert('No eligible offers.');
          
          return;
        }
      
       if (confirm('How about adding a delicious cookie for $3 more?')) {
         updateCart([{id: 'combo', product: 'Coffee + Cookie Combo', price: 8}]);
       }
    });
  } 
  
  function updateCart(items) {
    croct.track('cartModified', {
      cart: {
        currency: 'USD',
        total: items.reduce((total, {price}) => total + price, 0),
        items: items.map(({id, product, price}, index) => ({
          index: 0,
          total: price,
          quantity: 1,
          product: {
            productId: id,
            name: product,
            displayPrice: price
          }
        })),
      }
    }).then(() => alert('Cart updated!'));
  }

  function like(contentId) {
    croct.track('eventOccurred', {
      name: 'like',
      details: {
        contentId: contentId
      }
    }).then(() => alert('Tracked'));
  }

  function identify() {
    croct.identify(prompt('Please enter your ID:'));
  }

  function getUserId() {
    alert(croct.getUserId());
  }
  
  function anonymize() {
    croct.anonymize();
  }
  
</script>
</body>
</html>