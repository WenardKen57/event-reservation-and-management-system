const customer_transactions_btn = document.querySelector('#customer-transactions-btn')
const customer_transactions = document.querySelector('#customer-transactions');

customer_transactions.style.display = "none";

customer_transactions_btn.addEventListener('click', () => {
  customer_transactions.style.display = "block";
})