import { ComponentFixture, TestBed } from '@angular/core/testing';
import { AddGalleryPage } from './add-gallery.page';

describe('AddGalleryPage', () => {
  let component: AddGalleryPage;
  let fixture: ComponentFixture<AddGalleryPage>;

  beforeEach(async(() => {
    fixture = TestBed.createComponent(AddGalleryPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
