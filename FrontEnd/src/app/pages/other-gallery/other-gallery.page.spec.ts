import { ComponentFixture, TestBed } from '@angular/core/testing';
import { OtherGalleryPage } from './other-gallery.page';

describe('OtherGalleryPage', () => {
  let component: OtherGalleryPage;
  let fixture: ComponentFixture<OtherGalleryPage>;

  beforeEach(async(() => {
    fixture = TestBed.createComponent(OtherGalleryPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
