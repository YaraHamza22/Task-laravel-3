create table posts 
then create model post content 
protected fillable
protected cast
protected dates 

create formRequest for validation: 
PostStoreRequest 
PostUpdateRequest

then create class services PostService contains logical operations for a clean code 
create PostController abstract Controller return response json 
-------------------------------------------------------------------
index
{
  "status": "success",
  "message": "Operation successful",
  "data": []
}
-----------------------------------------------------
store
{
  "status": "success",
  "message": "Post Created Successfully",
  "data": {
    "title": "مقال تجريبي",
    "slug": "test-article-125",
    "body": "هذا محتوى المقال التجريبي",
    "is_published": true,
    "published_date": "2025-05-25T12:00:00.000000Z",
    "meta_description": "وصف تجريبي للمقال",
    "tags": [
      "tag1",
      "tag2",
      "tag3"
    ],
    "updated_at": "2025-05-06T00:08:51.000000Z",
    "created_at": "2025-05-06T00:08:51.000000Z",
    "id": 2
  }
}
---------------------------------------------------------------
update
{
  "status": "error",
  "messages": "التحقق فشل",
  "error": {
    "title": [
      "الحقل الخاص بالعنوان مطلوب"
    ],
    "body": [
      "The المجتوى field is required."
    ]
  }
}
--------------------------------------------------------
delete
{
  "status": "success",
  "message": "post deleted successfully",
  "data": null
}
_______________________________


