15.times do
    Book.create({
        title: Faker::Book.title,
        author: Faker::Book.author,
        publisher: Faker::Book.publisher,
        year: rand(1980..2020)
    })
end