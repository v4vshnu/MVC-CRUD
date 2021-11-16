module Api
    module V1
        class LibraryController < ApplicationController
            def index
                books = Book.order('id ASC');
                render json: {status: 'HTTP 200 OK', message:'All the books is in the library have been loaded', data:books},status: :ok
            end
            def show
                book = Book.find(params[:id])
                render json: {status: 'HTTP 200 OK', message:'The book has been loaded', data:book},status: :ok
            end
            def create
                book = Book.new(book_params)
                if book.save
                    render json: {status: 'HTTP 200 OK', message:'New Book has been added to the Database', data:book},status: :ok
                else
                    render json: {status: 'ERROR', message:'Error Adding the new book.', data:books.errors},status: :unprocessable_entity
                end
            end
            def destroy
                book = Book.find(params[:id])
                book.destroy
                render json: {status: 'HTTP 200 OK', message:'The book has been deleted', data:book},status: :ok

            end
            def update
               book = Book.find(params[:id])
               if book.update(book_params)
                render json: {status: 'HTTP 200 OK', message:'Details of the book has been updated', data:book},status: :ok
               else
                render json: {status: 'ERROR', message:'Error updating the details of the book', data:Book.errors},status: :unprocessable_entity
               end
                
            end

            private

            def book_params
                params.permit(:title, :author, :publisher, :year)
            end
        end
    end
end