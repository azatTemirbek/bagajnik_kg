import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-whatsapp',
  templateUrl: './whatsapp.component.html',
  styleUrls: ['./whatsapp.component.css']
})
export class WhatsappComponent implements OnInit {
  @Input() phone;
  @Input() message: string;
  link: String;
  encodeText: any;
  constructor() { }
  ngOnInit() {
    this.encodeText = encodeURI(this.message);
    this.link = 'whatsapp://wa.me/' + this.phone + this.encodeText;
  }
}
