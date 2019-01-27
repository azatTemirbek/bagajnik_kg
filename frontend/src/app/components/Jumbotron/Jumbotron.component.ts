import { Component, ViewChild, ElementRef } from '@angular/core';

@Component({
  selector: 'app-jumbotron',
  templateUrl: './Jumbotron.component.html',
  styleUrls: ['./Jumbotron.component.css']
})
export class JumbotronComponent {
  @ViewChild('bnb') bnb: ElementRef;
  constructor() { }
  changeBG() {
    this.bnb.nativeElement.style.backgroundImage = `url("https://source.unsplash.com/900x400/?${Math.floor(Math.random() * (5 - 1) + 1)}")`;
  }
}
