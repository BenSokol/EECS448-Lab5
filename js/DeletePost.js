document.querySelector('.delete-button').addEventListener('click', () => {
  let message_box = document.getElementsByClassName('message-box')[0]
  message_box.remove()
})
