export class User {
  name: String;
  surname: String;
  phone: String;
  email: String;
  fullName() {
    return `${this.surname} ${this.name}`;
  }
  validateEmail(email): Boolean {
    const mail = email || this.email;
    // tslint:disable-next-line:max-line-length
    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(mail);
  }
}
