import { ComponentFixture, TestBed } from '@angular/core/testing';
import { EventPicturesPage } from './event-pictures.page';

describe('EventPicturesPage', () => {
  let component: EventPicturesPage;
  let fixture: ComponentFixture<EventPicturesPage>;

  beforeEach(async(() => {
    fixture = TestBed.createComponent(EventPicturesPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
