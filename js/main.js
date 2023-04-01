const openMail = (to, subject, body) => {
  let url = `https://mail.google.com/mail/?view=cm&fs=1&to=${to}&su=${subject}&body=${body}`;
  window.open(url, "_blank");
};


