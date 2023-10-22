<div id="contact">
    <h1><?= $title ?? "Contact" ?></h1>
    <div class="account-page">
        <div class="container">
          <div class="row">
            <div class="col-2">
              <div class="contact-logo">
                  <img src="images/business/logo.png" alt="logo">
              </div>
            </div>
            <div class="col-2">
              <div class="form-container">
                <div class="form">
                  <p>Contact Form:</p>
                  <p>Biotec-For-U</p>
                </div>
                <form action="https://formsubmit.co/alivesoftware117@gmail.com" method="POST"> <!-- uses formsubmit web service to send email-->
                  <input type="text" name = "name" placeholder="Name" required>
                  <input type="email" name = "email" placeholder="Email" required>
                  <input type="text" name ="subject" placeholder="Subject">
                  <textarea name = "message" placeholder="Your message" rows="3"></textarea>
                  <button type="submit" class="btn">Send</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="small-container">
        <div class="contact-us">
            <h1>Contact Us</h1>
            <br>
            <br>
            <div class="contact-info">
                Email: customer.service@biotechforu.ca
                <br>
                Telephone: +519 291 0361
                <br>
                Address: 618 Holland Place, Toronto, Canada M1G 4I9
            </div>
        </div>
    </div>
</div>