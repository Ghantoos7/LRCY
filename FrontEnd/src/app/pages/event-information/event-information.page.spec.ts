import { ComponentFixture, TestBed } from '@angular/core/testing';
import { EventInformationPage } from './event-information.page';

describe('EventInformationPage', () => {
  let component: EventInformationPage;
  let fixture: ComponentFixture<EventInformationPage>;

  beforeEach(async(() => {
    fixture = TestBed.createComponent(EventInformationPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
