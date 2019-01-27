import { Component, OnInit } from '@angular/core';
import { NgForm } from '@angular/forms';

@Component({
  selector: 'app-contact',
  templateUrl: './Contact.component.html',
  styleUrls: ['./Contact.component.css']
})
export class ContactComponent implements OnInit {

  constructor() { }
  ngOnInit() {
  }
  mailto(form: NgForm) {
    let value = '';
    Object.keys(form.value).forEach(key => {
      value = `&${key}=${form.value[key]}`;
    });
    window.location.href = `mailto:abc@abc.com?subject=contact&body=Hi${value}`;
  }
}
