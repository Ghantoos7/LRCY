import { ComponentFixture, TestBed } from '@angular/core/testing';
import { YouthGalleryPage } from './youth-gallery.page';

describe('YouthGalleryPage', () => {
  let component: YouthGalleryPage;
  let fixture: ComponentFixture<YouthGalleryPage>;

  beforeEach(async(() => {
    fixture = TestBed.createComponent(YouthGalleryPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
