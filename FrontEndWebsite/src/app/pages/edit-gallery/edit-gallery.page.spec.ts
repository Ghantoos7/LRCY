import { ComponentFixture, TestBed } from '@angular/core/testing';
import { EditGalleryPage } from './edit-gallery.page';

describe('EditGalleryPage', () => {
  let component: EditGalleryPage;
  let fixture: ComponentFixture<EditGalleryPage>;

  beforeEach(async(() => {
    fixture = TestBed.createComponent(EditGalleryPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
