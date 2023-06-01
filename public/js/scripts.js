$(document).ready(function () {
  // Get current page URL
  var url = window.location.href;

  // Get sidebar links
  var sidebarLinks = $(".sidebar a");

  // Set active link
  sidebarLinks.removeClass("active");
  sidebarLinks.each(function () {
    if (url.indexOf($(this).attr("href")) !== -1) {
      $(this).addClass("active");
    }
  });
});

// JS untuk tampilan login
$("#form")
  .find("input, textarea")
  .on("keyup blur focus", function (e) {
    var $this = $(this),
      label = $this.prev("label");

    if (e.type === "keyup") {
      if ($this.val() === "") {
        label.removeClass("active highlight");
      } else {
        label.addClass("active highlight");
      }
    } else if (e.type === "blur") {
      if ($this.val() === "") {
        label.removeClass("active highlight");
      } else {
        label.removeClass("highlight");
      }
    } else if (e.type === "focus") {
      if ($this.val() === "") {
        label.removeClass("highlight");
      } else if ($this.val() !== "") {
        label.addClass("highlight");
      }
    }
  });

// Delete confirmation
// document.getElementById("delete-tweet").addEventListener("click", function (event) {
//   event.preventDefault(); // menghentikan tindakan delete dilakukan langsung oleh browser
// Swal.fire({
//   title: 'Do you really want to delete this tweet?',
//   showDenyButton: true,
//   showCancelButton: true,
//   confirmButtonText: 'Delete',
//   denyButtonText: `Don't delete`,
// }).then((result) => {
//   /* Read more about isConfirmed, isDenied below */
//   if (result.isConfirmed) {
//     Swal.fire({
//       position: 'center',
//       icon: 'success',
//       title: 'Your tweet has been deleted',
//       showConfirmButton: false,
//       timer: 1500
//     })
//     // melanjutkan tindakan delete dilakukan langsung oleh browser
//     window.location.href = "delete-tweet.php";
//   } else if (result.isDenied) {
//     Swal.fire('Tweet is not deleted', '', 'info')
//   }
// })
// });

// Logout confirmation
document.getElementById("logout-link").addEventListener("click", function (event) {
  event.preventDefault(); // menghentikan tindakan logout dilakukan langsung oleh browser
  if (confirm("Anda yakin ingin logout?")) {
    // menampilkan peringatan dan konfirmasi tindakan logout
    window.location.href = "logout.php"; // jika dikonfirmasi, maka arahkan ke halaman logout
  }
});

function changeColor(button) {
  button.querySelector(".icon-wrapper").classList.toggle("clicked");
}

// AJAX untuk tombol like

