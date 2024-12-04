# chickflick-api

Welcome to the ChickFlicks API, a dynamic application designed to provide seamless access to a curated collection of chick flicks. Built using straightforward PHP and Object-Oriented Programming (OOP) principles, this API offers an efficient and user-friendly interface for retrieving movie data, including titles, ratings (IMDb), and descriptions (Wikipedia). With its clean architecture and easy-to-understand structure, this project demonstrates the power of PHP's OOP capabilities while delivering an engaging experience for users. Dive in and explore the wonderful world of chick flicks!  

## Documentation

1. Get all films

    > GET /films

    Description:
    Retrieve a list of all films in the collection.

    Response:
    Status code: 200 OK
    Body:
        {
            "id": 1,
            "title": "Bridget Jones's Diary",
            "description": "Bridget Jones is a 32-year-old British single woman, who writes a diary which focuses on the things she wishes to happen in her life. However, her life changes when two men vie for her affection, one is her boss and the other one is a top-notch barrister that her mum tries to set her up with.",
            "rating": 6,8,
            "include_adult_content": false,
            "film_language": "English",
            "release_date": "2001-04-13",
            "running_time": 96,
            "starring": "Renée Zellweger, Colin Firth, Hugh Grant",
            "directed_by": "Sharon Maguire",
            "screenplay_by": "Helen Fielding, Andrew Davies, Richard Curtis",
            "img": "bridget-jones-diary.jpeg"
        },
        {
            "id": 2,
            "title": "Pride and Prejudice",
            "description": "Pride & Prejudice is a 2005 historical romantic drama film directed by Joe Wright, in his feature directorial debut, and based on Jane Austen's 1813 novel of the same name. The film features five sisters from an English family of landed gentry as they deal with issues of marriage, morality and misconceptions.",
            "rating": 7,8,
            "include_adult_content": false,
            "film_language": "English",
            "release_date": "2005-09-11",
            "running_time": 127,
            "starring": "Keira Knightley, Matthew Macfayden, Brenda Blethyn",
            "directed_by": "Joe Wright",
            "screenplay_by": "Deborah Moggach, Jane Austen, Emma Thompson",
            "img": "pride-and-prejudice.png"
        },

2. Get a single film

    > GET films/{id}

    Description:
    Retrieve a specific film by its ID.

    Response:
    Status: 200 OK
    Body:
        {
            "id": 1,
            "title": "Bridget Jones's Diary",
            "description": "Bridget Jones is a 32-year-old British single woman, who writes a diary which focuses on the things she wishes to happen in her life. However, her life changes when two men vie for her affection, one is her boss and the other one is a top-notch barrister that her mum tries to set her up with.",
            "rating": 6,8,
            "include_adult_content": false,
            "film_language": "English",
            "release_date": "2001-04-13",
            "running_time": 96,
            "starring": "Renée Zellweger, Colin Firth, Hugh Grant",
            "directed_by": "Sharon Maguire",
            "screenplay_by": "Helen Fielding, Andrew Davies, Richard Curtis",
            "img": "bridget-jones-diary.jpeg"
        }

3. Create a film

    > POST /films

    Body:
        {
            "title": "Bridget Jones the Edge of Reason",
            "description": "Bridget Jones is ecstatic about her new relationship with Mark Darcy. However, her confidence is shattered when she meets Mark's assistant, the beautiful, slim, quick-witted Rebecca Gillies.",
            "rating": 6,
            "include_adult_content": false,
            "film_language": "English",
            "release_date": "2004-11-12",
            "running_time": 108,
            "starring": "Renée Zellweger, Colin Firth, Hugh Grant, Jim Broadbent, Gemma Jones",
            "directed_by": "Beeban Kidron",
            "screenplay_by": "Helen Fielding, Andrew Davies, Richard Curtis, Adam Brooks",
            "img": "bridget-jones-edge-of-reason.jpeg"
        }

    Response:
    Status: 201 Created
    Body:
        {
            "id": 3,
            "title": "Bridget Jones the Edge of Reason",
            "description": "Bridget Jones is ecstatic about her new relationship with Mark Darcy. However, her confidence is shattered when she meets Mark's assistant, the beautiful, slim, quick-witted Rebecca Gillies.",
            "rating": 6,
            "include_adult_content": false,
            "film_language": "English",
            "release_date": "2004-11-12",
            "running_time": 108,
            "starring": "Renée Zellweger, Colin Firth, Hugh Grant, Jim Broadbent, Gemma Jones",
            "directed_by": "Beeban Kidron",
            "screenplay_by": "Helen Fielding, Andrew Davies, Richard Curtis, Adam Brooks",
            "img": "bridget-jones-edge-of-reason.jpeg"
        }

4. Update a movie

    > PATCH films/{id}

    Description:
    Update an existing film by its id.

    Body:
        {
            "title": "Bridget Jones the Edge of Reason",
            "description": "Bridget Jones is ecstatic about her new relationship with Mark Darcy. However, her confidence is shattered when she meets Mark's assistant, the beautiful, slim, quick-witted Rebecca Gillies.",
            "rating": 6,
            "include_adult_content": false,
            "film_language": "English",
            "release_date": "2004-11-12",
            "running_time": 108,
            "starring": "Renée Zellweger, Colin Firth, Hugh Grant, Jim Broadbent, Gemma Jones",
            "directed_by": "Beeban Kidron",
            "screenplay_by": "Helen Fielding, Andrew Davies, Richard Curtis, Adam Brooks",
            "img": "bridget-jones-edge-of-reason.png"
        }

    Response:
    Status code: 200 OK
    Body:
        {
            "id": 3,
            "title": "Bridget Jones the Edge of Reason",
            "description": "Bridget Jones is ecstatic about her new relationship with Mark Darcy. However, her confidence is shattered when she meets Mark's assistant, the beautiful, slim, quick-witted Rebecca Gillies.",
            "rating": 6,
            "include_adult_content": false,
            "film_language": "English",
            "release_date": "2004-11-12",
            "running_time": 108,
            "starring": "Renée Zellweger, Colin Firth, Hugh Grant, Jim Broadbent, Gemma Jones",
            "directed_by": "Beeban Kidron",
            "screenplay_by": "Helen Fielding, Andrew Davies, Richard Curtis, Adam Brooks",
            "img": "bridget-jones-edge-of-reason.jpeg"
        }

5. Delete a movie

    > DELETE films/{id}

    Description:
    Remove a film from the collection by its ID.

    Response:
    Status Code: 200 OK

### Database

The SQL file located at the root of the project (database.sql) provides instructions for creating the "film" table. 
It does not include instructions for creating the database itself, which was done intentionally to prevent overwriting any existing database.
