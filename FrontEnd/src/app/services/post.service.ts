import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class PostService {
  private base_url = 'http://localhost:8000/api/v0.1/post/';

  constructor(private http:HttpClient) { }

  getPosts(){
    const response = this.http.get(this.base_url + 'get_posts');
    return response;
  }
}
