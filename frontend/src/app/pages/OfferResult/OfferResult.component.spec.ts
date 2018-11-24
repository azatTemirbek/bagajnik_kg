/* tslint:disable:no-unused-variable */
import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { By } from '@angular/platform-browser';
import { DebugElement } from '@angular/core';

import { OfferResultComponent } from './OfferResult.component';

describe('OfferResultComponent', () => {
  let component: OfferResultComponent;
  let fixture: ComponentFixture<OfferResultComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ OfferResultComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(OfferResultComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
