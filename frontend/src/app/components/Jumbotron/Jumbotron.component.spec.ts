/* tslint:disable:no-unused-variable */
import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { By } from '@angular/platform-browser';
import { DebugElement } from '@angular/core';

import { JumbotronComponent } from './Jumbotron.component';

describe('JumbotronComponent', () => {
  let component: JumbotronComponent;
  let fixture: ComponentFixture<JumbotronComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ JumbotronComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(JumbotronComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
