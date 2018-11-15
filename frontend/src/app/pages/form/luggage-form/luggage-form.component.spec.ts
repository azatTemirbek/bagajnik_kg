import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { LuggageFormComponent } from './luggage-form.component';

describe('LuggageFormComponent', () => {
  let component: LuggageFormComponent;
  let fixture: ComponentFixture<LuggageFormComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ LuggageFormComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(LuggageFormComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
