var menu = document.querySelector(".menu")
var toggle = document.querySelector(".menu__footer__toggle")

var districts = [
  {
    name: "Курчалоевский район",
    notifications: [
      {
        status: "Добавлена задача",
        date: "Сегодня, 20:22"
      },
      {
        status: "Добавлена задача",
        date: "Сегодня, 20:22"
      },
      {
        status: "Добавлена задача",
        date: "Сегодня, 20:22"
      }
    ],
    notificationCount:  3
  },
  {
    name: "Гудермесский район",
    notifications: [
      {
        status: "Добавлена задача",
        date: "Сегодня, 20:22"
      },
      {
        status: "Добавлена задача",
        date: "Сегодня, 20:22"
      },
    ],
    notificationCount:  2
  },
  {
    name: "Грозненский район",
    notifications: [
      {
        status: "Добавлена задача",
        date: "Сегодня, 20:22"
      },
      {
        status: "Добавлена задача",
        date: "Сегодня, 20:22"
      },
      {
        status: "Добавлена задача",
        date: "Сегодня, 20:22"
      },
      {
        status: "Добавлена задача",
        date: "Сегодня, 20:22"
      },
      {
        status: "Добавлена задача",
        date: "Сегодня, 20:22"
      }
    ],
    notificationCount:  5
  },

]

var date = String(new Date())

toggle.children[0].addEventListener("click", e => menu.classList.toggle("menu__folded"))
