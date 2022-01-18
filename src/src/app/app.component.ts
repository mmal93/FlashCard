import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
 
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.sass']
})
export class AppComponent implements OnInit {
  posts = [] as any;
 
  constructor(private http: HttpClient){}
 
  ngOnInit(): void{
    this.http.get('http://localhost/angular/be1/admin/wp-json/wp/v2/flashcard?_embed').subscribe((data) =>{
      for(let key in data){
        if(data.hasOwnProperty(key)){
          let d = (data as any)[key];
          this.posts.push(d);
          console.log(data);
        }
      }
      // console.log(this.posts);
    })
  }
 
}